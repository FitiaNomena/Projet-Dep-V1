<?php
include("inc/fonctions.php");
$conn = connectToDatabase("localhost", "root", "", "employees");
$departements = getDepartementsWithManager($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Projet_Departement</title>
</head>

<body>
    <header class="mt-4">
    <?php
        include ("inc/menu.php");
        ?>
        <h1 class="mt-4 text-center fs-3 text-info-emphasis ">Liste des Departements</h1>
       
    </header>
    <main class="mx-auto p-2 bg-white text-emphasis-primary " width="500px" >
        <div class="container mt-4">
            <table class="table table-primary table-striped-columns">
                <tr>
                    
                    <th class="text-center text-primary">Nom de departement</th>
                    <th class="text-center text-primary">Manager en cours</th>
                    <th class="text-center text-primary">employees</th>

                </tr>
                <?php while ($row = mysqli_fetch_assoc($departements)): ?>
                    <tr>
                        
                        <td><?= htmlspecialchars($row['dept_name']) ?></td>
                        <td><?= htmlspecialchars($row['manager_first_name'] . " " . $row['manager_last_name']) ?></td>
                        <td>
                           <a href="pages/liste_employee.php?dept_no=<?= $row['dept_no'] ?>">
                                Voir employés
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>

            </table>
        </div>
    </main>

</body>

</html>