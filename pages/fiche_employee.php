<?php
include("../inc/fonctions.php");

if (!isset($_GET['emp_no'])) {
    echo "Aucun employé sélectionné.";
    exit;
}

$emp_no = $_GET['emp_no'];
$dept_no = $_GET['dept_no'] ?? null;

$conn = connectToDatabase("localhost", "root", "", "employees");

// Récupération des données
$info = getEmployeeInfo($conn, $emp_no);
$departements      = getEmployeeDepartments($conn, $emp_no);
$salaireHistorique = getEmployeeSalaries($conn, $emp_no);
$titresHistorique  = getEmployeeTitles($conn, $emp_no);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche Employé</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <header>
    <?php
        include("../inc/menu.php");
        ?>

<a href="liste_employee.php?dept_no=<?= htmlspecialchars($dept_no) ?>" class="btn btn-secondary mb-3 mt-4">
    ← Retour à la liste
</a>


    <h1 class="mb-4">Fiche de l'employé n°<?= htmlspecialchars($emp_no) ?></h1>
    </header>
    <main>
    <div class="card p-3 mb-4">
        <h4 class="text-primary">Identité</h4>
        <ul>
            <li><strong>Nom complet :</strong> <?= htmlspecialchars($info['first_name'] . " " . $info['last_name']) ?></li>
            <li><strong>Genre :</strong> <?= $info['gender'] == 'M' ? 'Homme' : 'Femme' ?></li>
            <li><strong>Date de naissance :</strong> <?= formatDateFR($info['birth_date']) ?> (<?= calculerAge($info['birth_date']) ?> ans)</li>
            <li><strong>Date d'embauche :</strong> <?= formatDateFR($info['hire_date']) ?></li>
        </ul>
    </div>

    <div class="card p-3 mb-4">
        <h4 class="text-primary">Historique des départements</h4>
        <?php if (mysqli_num_rows($departements) > 0): ?>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($departements)): ?>
                    <li>
                        <?= htmlspecialchars($row['dept_name']) ?>
                        (du <?= formatDateFR($row['from_date']) ?> au <?= formatDateFR($row['to_date']) ?>)
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p class="text-danger">Aucun département trouvé pour cet employé.</p>
        <?php endif; ?>
    </div>

    <div class="card p-3 mb-4">
        <h4 class="text-primary">Historique des salaires</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Montant (€)</th>
                    <th>Du</th>
                    <th>Au</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($salaireHistorique)): ?>
                    <tr>
                        <td><?= $row['salary'] ?></td>
                        <td><?= formatDateFR($row['from_date']) ?></td>
                        <td><?= formatDateFR($row['to_date']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="card p-3 mb-4">
        <h4 class="text-primary">Historique des postes occupés</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Du</th>
                    <th>Au</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($titresHistorique)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= formatDateFR($row['from_date']) ?></td>
                        <td>
                            <?= $row['to_date'] 
                                ? formatDateFR($row['to_date']) 
                                : 'Actuel' 
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    </main>
</body>
</html>
