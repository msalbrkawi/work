<?php
global $params;

//check if user has role admin
if (!isAdmin()) {
    logout();
    header ("location:/inloggen");
} else {
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
            $employees = getEmployees($_SESSION['AId']);
            include_once "../Templates/admin/working_hours.php";
            break;

        case 'werknemer_werk_uren':
            $titleSuffix = ' | werk_uren';
            $employee = getEmployee($params[3]);
            if (isset($_POST['filter'])){
                $employeesSalary = filter($params[3]);
            }elseif (isset($_POST['reset'])){
                $employeesSalary = employeesSalary($params[3]);
            }
            else{
                $employeesSalary = employeesSalary($params[3]);
            }
            include_once "../Templates/admin/werknemer_werk_uren.php";
            break;

            default:
            header("location: /inloggen");
            break;
    }
}