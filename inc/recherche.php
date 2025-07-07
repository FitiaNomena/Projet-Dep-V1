<?php include("fonctions.php");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Recherche d'employés</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="container mt-5">
    <h1 class="mt-4 text-center fs-3 text-info-emphasis ">Recherche d'employés</h1>
    <form action="../pages/employes_recherche.php" method="get" class="row g-3">

        <div class="col-md-4">
            <label for="dept_no" class="form-label">Code du département</label>
            <input type="text" name="dept_no" id="dept_no" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="name" class="form-label">Nom de l'employé (optionnel)</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <div class="col-md-2">
            <label for="age_min" class="form-label">Âge min</label>
            <input type="number" name="agmb-4 fs-3 texte_min" id="age_min" class="form-control">
        </div>

        <div class="col-md-2">
            <label for="age_max" class="form-label">Âge max</label>
            <input type="number" name="age_max" id="age_max" class="form-control">
        </div>

        <div class="col-12">
            <button class="btn btn-primary mt-2">Rechercher</button>
            <a href="../index.php" class="btn btn-secondary mt-2">Retour à l'accueil</a>
        </div>

    </form>
</body>

</html>