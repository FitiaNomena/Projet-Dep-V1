<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des Propriétés</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
        
            <!-- Menu principal -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto text-primary">
                    <li class="nav-item"><a class="nav-link active" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/liste_employee.php">Employés</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Fiche Employés</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pages</a></li>

                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>

                <!-- Lien déconnexion à droite -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-danger fw-bold" href="../index.php">Déconnexion</a>
                    </li>
                    <!-- Lien rechercher à droite -->
                    <li class="nav-item">


                        <a class="nav-link text-primary fw-bold" href="inc/recherche.php">
                            <i class="bi bi-search"></i> Rechercher
                        </a>


                    </li>
                </ul>
            </div>
        </div>
    </nav>


</body>

</html>