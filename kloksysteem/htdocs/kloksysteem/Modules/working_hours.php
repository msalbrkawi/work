<?php

function employeesSalary(){
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
    $query = $db->prepare("
SELECT * 
FROM salary
INNER JOIN employee
ON employee.employee_id = salary.employee_id
where status = :status and salary.manger_id = :manger_id
order by salary.start_date

");
    $status = "Not Active";
    $manger_id = $_SESSION['AId'];
    $query->bindParam("manger_id", $manger_id );
    $query->bindParam("status", $status);
    $query->execute();

    $employeesSalary = $query->fetchAll(PDO::FETCH_ASSOC);

    return  $employeesSalary;
}
