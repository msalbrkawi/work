<?php

function filter($id){
        $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
        $query = $db->prepare("
SELECT * 
FROM salary
where status = :status and manger_id = :manger_id and employee_id = :employee_id and month = :month and year = :year
order by start_date

");
        $status = "Not Active";
        $manger_id = $_SESSION['AId'];
        $employee_id = $id;
        $year = $_POST['year'];
        $month = $_POST['month'];
        $query->bindParam("year", $year);
        $query->bindParam("month", $month);
        $query->bindParam("employee_id", $employee_id);
        $query->bindParam("manger_id", $manger_id);
        $query->bindParam("status", $status);
        $query->execute();

        $employeesSalary = $query->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['result_msg'] = "Resultaat van jaar ".$year." en maand ".$month;

        return  $employeesSalary;

}

function employeesSalary($id){
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
    $query = $db->prepare("
SELECT * 
FROM salary
where status = :status and manger_id = :manger_id and employee_id = :employee_id
order by start_date

");
    $status = "Not Active";
    $manger_id = $_SESSION['AId'];
    $employee_id = $id;
    $query->bindParam("employee_id", $employee_id );
    $query->bindParam("manger_id", $manger_id );
    $query->bindParam("status", $status);
    $query->execute();

    $employeesSalary = $query->fetchAll(PDO::FETCH_ASSOC);

    return  $employeesSalary;
}