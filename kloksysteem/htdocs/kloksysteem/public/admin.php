<?php
global $params;

//check if user has role admin
if (!isAdmin()) {
    logout();
    header ("location:/inloggen");
} else {
/* $params[2] is de action
   $params[3] is een getal die de delete action nodig heeft
*/
    switch ($params[2]) {

        case 'dashboard':
            $titleSuffix = ' | Dashboard';
            include_once "../Templates/admin/dashboard.php";
            break;

        case 'werknemmers':
            $titleSuffix = ' | Dashboard';
            $employees = getEmployees($_SESSION['AId']);
            include_once "../Templates/admin/employees.php";
            break;

        case 'werknemer':
            $titleSuffix = ' | werknemer';
            $employee = getEmployee($params[3]);
            if (checkUser() == true){
                updateEmployee($params[3]);
                header('location: /admin/dashboard');
            }
            include_once "../Templates/admin/employee.php";
            break;

        case 'werknemmer_toeveogen':
            $titleSuffix = ' | werknemmer toeveogen';
            if (checkUser() == true){
                registerUser();
            }
            include_once "../Templates/admin/addEmployee.php";
            break;

        case 'overzicht':
            $titleSuffix = ' | Overzicht';
            overzicht();
            if (isset($_SESSION['salary_id'])){
                employeeStop($_SESSION['salary_id']);
            }
            employeeStart();
            $salary = getSalary();
            include_once "../Templates/admin/overzicht.php";
            break;

        case 'werk_uren':
            $titleSuffix = ' | werk_uren';
            $employeesSalary = employeesSalary();
            include_once "../Templates/admin/working_hours.php";
            break;

            default:
            header("location: /inloggen");
            break;
    }
}