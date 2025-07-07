<?php
include("../inc/fonctions.php");

$dept_no = isset($_GET['dept_no']) ? $_GET['dept_no'] : null;

$conn = connectToDatabase("localhost", "root", "", "employees");
//appel de la fonction qui obtient les employees/ Departement
$employees = getEmployeesFromDepartment($conn, $dept_no);

//appel de la fonction pour afficher le nom du Departement selectionee
$dept_name = getDepartmentName($conn, $dept_no);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Projet_Departement</title>
</head>

<body>
    <header>
        <?php
        include("../inc/menu.php");
        ?>
        <h1>Employés du département : <?= htmlspecialchars($dept_name) ?> (<?= $dept_no ?>)</h1>
        <a href="../index.php" class="btn btn-secondary mb-3"> Retour</a>

    </header>
    <main>
        <table class="table table-bordered ">
            <thead class="table-light">
                <tr>
                    <th class=" text-primary">Numéro</th>
                    <th class=" text-primary">Nom</th>
                    <th class=" text-primary">Date d'embauche</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($employees)): ?>
                    <tr>
                        <td><?= $row['emp_no'] ?></td>
                        <td>
                        <a href="fiche_employee.php?emp_no=<?= $row['emp_no'] ?>&dept_no=<?= $dept_no ?>">

                                <?= htmlspecialchars($row['first_name'] . " " . $row['last_name']) ?>
                            </a>
                        </td>

                        <td><?= formatDateFR($row['hire_date'] )?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>

</html>