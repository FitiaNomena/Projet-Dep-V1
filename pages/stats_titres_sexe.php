<?php
include("../inc/fonctions.php");
$conn = connectToDatabase("localhost", "root", "", "employees");

if (!isset($_GET['dept_no'])) {
    die("Département non spécifié");
}

$dept_no = $_GET['dept_no'];
$stats = getStatsTitreParDepartement($conn, $dept_no);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques - Département <?= htmlspecialchars($dept_no) ?></title>
    
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-4">
    <?php include("../inc/menu.php"); ?>

    <a href="../index.php" class="btn btn-secondary mb-3">← Retour</a>
    <h2 class="text-info mb-4">Statistiques des titres pour le département <strong><?= htmlspecialchars($dept_no) ?></strong></h2>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Titre</th>
                <th>Hommes</th>
                <th>Femmes</th>
                <th>Salaire moyen (€)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($stats)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td class="text-center"><?= $row['nb_hommes'] ?></td>
                    <td class="text-center"><?= $row['nb_femmes'] ?></td>
                    <td class="text-end"><?= number_format($row['salaire_moyen'], 2, ',', ' ') ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
