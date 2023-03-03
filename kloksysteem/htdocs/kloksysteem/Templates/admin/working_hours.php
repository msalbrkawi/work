<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');
include_once('../Templates/defaults/navbar.php');
?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Naam</th>
        <th scope="col">Datum:</th>
        <th scope="col">Begintijd:</th>
        <th scope="col">Eindtijd:</th>
        <th scope="col">salaris:</th>
    </tr>
    </thead>
    <tbody>
    <?php global $employeesSalary; foreach ($employeesSalary as $employeeSalary):?>
    <tr>
        <td><?= $employeeSalary['employee_first_name']. " ". $employeeSalary['employee_last_name']?></td>
        <td><?= $employeeSalary['day_date']?></td>
        <td><?= $str = str_replace(":00", "", $employeeSalary['start_date'])?></td>
        <td><?= $str = str_replace(":00", "", $employeeSalary['end_date'])?></td>
        <td>&euro; <?= number_format($employeeSalary['salary'],"2",",",".")?>,-</td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>

<?php
include_once ('../Templates/defaults/footer.php');
?>

</body>
</html>