<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../inc/fonctions.php");

$conn = connectToDatabase();

$dept_no = isset($_GET['dept_no']) ? trim($_GET['dept_no']) : '';
$name = isset($_GET['name']) ? trim($_GET['name']) : '';
$age_min = isset($_GET['age_min']) && is_numeric($_GET['age_min']) ? (int)$_GET['age_min'] : null;
$age_max = isset($_GET['age_max']) && is_numeric($_GET['age_max']) ? (int)$_GET['age_max'] : null;

// Numéro de page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

if (empty($dept_no)) {
    die("Le code département est obligatoire.");
}

$where = "d.dept_no = '" . mysqli_real_escape_string($conn, $dept_no) . "'";
if ($name !== '') {
    $name_esc = mysqli_real_escape_string($conn, $name);
    $where .= " AND (e.first_name LIKE '%$name_esc%' OR e.last_name LIKE '%$name_esc%')";
}

// Requête de base pour compter tous les résultats
$count_sql = "SELECT COUNT(*) AS total
              FROM v_employees e
              JOIN dept_emp d ON e.emp_no = d.emp_no
              WHERE $where";
$count_result = mysqli_query($conn, $count_sql);
$total_rows = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_rows / $limit);

// Requête avec LIMIT pour pagination
$sql = "SELECT 
            e.emp_no,
            e.first_name,
            e.last_name,
            e.birth_date,
            e.hire_date
        FROM v_employees e
        JOIN dept_emp d ON e.emp_no = d.emp_no
        WHERE $where
        LIMIT $offset, $limit";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Erreur dans la requête : " . mysqli_error($conn));
}

// Filtrer âge en PHP
$filtered = [];
while ($row = mysqli_fetch_assoc($result)) {
    $age = calculerAge($row['birth_date']);
    if (($age_min !== null && $age < $age_min) || ($age_max !== null && $age > $age_max)) {
        continue;
    }
    $row['age'] = $age;
    $filtered[] = $row;
}

// Garder les paramètres pour les liens Suivant/Précédent
$params = [
    'dept_no' => $dept_no,
    'name' => $name,
    'age_min' => $age_min,
    'age_max' => $age_max
];
$queryString = http_build_query($params);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body class="container mt-5">
    <h1 class="mb-4 text-center">Résultats de la recherche d'employés</h1>

    <a href="../inc/recherche.php" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Nouvelle recherche</a>

    <?php if (count($filtered) === 0) : ?>
        <div class="alert alert-warning">Aucun employé ne correspond aux critères.</div>
    <?php else : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Âge</th>
                    <th>Date d'embauche</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filtered as $emp) : ?>
                    <tr>
                        <td><?= htmlspecialchars($emp['emp_no']) ?></td>
                        <td><?= htmlspecialchars($emp['first_name']) ?></td>
                        <td><?= htmlspecialchars($emp['last_name']) ?></td>
                        <td><?= $emp['age'] ?></td>
                        <td><?= formatDateFR($emp['hire_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

          <div class="mb-2 text-start">
          <strong>Page <?= $page ?> / <?= $total_pages ?></strong>
          </div>

        <!-- Pagination -->
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?= $queryString ?>&page=<?= $page - 1 ?>">Précédent</a>
                    </li>
                <?php endif; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?= $queryString ?>&page=<?= $page + 1 ?>">Suivant</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    <?php endif; ?>
</body>
</html>
