<?php

function connectToDatabase($host = 'localhost', $user = 'root', $password = '', $database = 'employees')
{
    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "utf8");
    return $conn;
}

/*function getDepartements($conn){  
    $sql="SELECT d.dept_no, d.dept_name 
    FROM departments d";
     $resultats = mysqli_query($conn, $sql);
     if (!$resultats) {
        die("Erreur dans la requête des départements : " . mysqli_error($conn));//erreur si il n' u a pas de departements affiches
    }

    return $resultats;

}*/

function getDepartementsWithManager($conn)
{
    $sql = "SELECT * FROM v_departments_managers";

    $resultats = mysqli_query($conn, $sql);

    return $resultats;
}

function getEmployeesFromDepartment($conn, $dept_no) {
    $dept_no = mysqli_real_escape_string($conn, $dept_no);
    $sql = "SELECT 
        e.emp_no,
        e.first_name,
        e.last_name,
        e.hire_date
    FROM v_employees e
    JOIN dept_emp d ON e.emp_no = d.emp_no
    WHERE d.dept_no = '$dept_no'";

    $resultats = mysqli_query($conn, $sql);

    return $resultats;
}



function getDepartmentName($conn, $dept_no) {
    $dept_no = mysqli_real_escape_string($conn, $dept_no);
    $sql = "SELECT dept_name FROM departments WHERE dept_no = '$dept_no'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['dept_name'];
    }
    return "Inconnu";
}

function getEmployeeTitles($conn, $emp_no) {
    $emp_no = mysqli_real_escape_string($conn, $emp_no);
    $sql = "SELECT title, from_date, to_date
            FROM titles
            WHERE emp_no = '$emp_no'
            ORDER BY from_date DESC";
    return mysqli_query($conn, $sql);
}

function getEmployeeSalaries($conn, $emp_no) {
    $emp_no = mysqli_real_escape_string($conn, $emp_no);
    $sql = "SELECT salary, from_date, to_date
            FROM salaries
            WHERE emp_no = '$emp_no'
            ORDER BY from_date DESC";
    return mysqli_query($conn, $sql);
}

function getEmployeeDepartments($conn, $emp_no) {
    $emp_no = mysqli_real_escape_string($conn, $emp_no);
    $sql = "SELECT d.dept_name, de.from_date, de.to_date
            FROM dept_emp de
            JOIN departments d ON de.dept_no = d.dept_no
            WHERE de.emp_no = '$emp_no'
            ORDER BY de.from_date DESC";
    return mysqli_query($conn, $sql);
}
function getEmployeeInfo($conn, $emp_no) {
    $emp_no = mysqli_real_escape_string($conn, $emp_no);
    $sql = "SELECT * FROM v_employees WHERE emp_no = '$emp_no'";
    $res = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($res);
}

// Calcul de l’âge
function calculerAge($dateNaissance) {
    $now = new DateTime();
    $naissance = new DateTime($dateNaissance);
    return $naissance->diff($now)->y;
}

// Helper pour formater une date au format d/m/Y
function formatDateFR($date) {
    if (!$date) return '';
    $dt = DateTime::createFromFormat('Y-m-d', $date);
    return $dt ? $dt->format('d/m/Y') : $date;
}

/*function getNombreEmployesParDepartement($conn) {
    $sql = "SELECT * FROM v_nombre_employes_par_departement";
    return mysqli_query($conn, $sql);
}*/

function getDepartementsComplets($conn) {
    $sql = "SELECT * FROM v_departements_complets";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Erreur SQL : " . mysqli_error($conn));
    }
    return $result;
}


?>

