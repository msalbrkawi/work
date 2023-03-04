<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');
include_once('../Templates/defaults/navbar.php');

$months = array("Jan", "Feb", "Mar", "Apr", "June", "July", "Aug", "Sept", "Nov", "Dec");
?>

<div class="container-fluid p-3 my-3 shadow">
    <form class="d-flex justify-content-center align-items-center" method="post">
        <div class="mx-2">
            <label for="year">Jaar:</label>
            <select name="year" id="year">
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select>
        </div>
        <div class="mx-2">
            <label for="month">Maand:</label>
            <select name="month" id="month">
                <?php foreach ($months as $month):?>
                <option value="<?= $month?>"><?= $month?></option>
                <?php endforeach;?>
            </select>
        </div>
        <input class="btn btn-sm btn-success rounded-3 ms-2" type="submit" name="filter" value="filter">
        <input class="btn btn-sm btn-warning rounded-3 ms-2" type="submit" name="reset" value="reset">

    </form>
</div>
<div class="ms-1">
    <a class="text-black" href="/admin/dashboard">Dashboard</a> / <a class="text-black" href="/admin/werk_uren">Werk uren</a>
</div>
<div class="display-6 mt-5 ms-1">
    <?php global $employee; foreach ($employee as $data):?>
    Werknemmer: <?= $data['employee_first_name'] . " " . $data['employee_last_name']?>
    <?php endforeach;?>
</div>
<div class="ms-1 my-3">
    <?php
    if (isset($_SESSION['result_msg'])){
        echo $_SESSION['result_msg'];
    }
    ?>
</div>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Datum:</th>
        <th scope="col">Begin tijd:</th>
        <th scope="col">Eind tijd:</th>
        <th scope="col">Gewerkte uren:</th>
        <th scope="col">Salaris:</th>
    </tr>
    </thead>
    <tbody>
    <?php
    global $employeesSalary;
    $total_salary = 0;
    $total_working_hours = 0;
    foreach ($employeesSalary as $employee):?>
        <tr>
            <td>
                <?= $employee['day_date']?>
            </td>
            <td>
                <?= str_replace(":00","",$employee['start_date'])?>
            </td>
            <td>
                <?= str_replace(":00","",$employee['end_date'])?>
            </td>
            <td>
                <?= round($employee['total_hours'],2)?>
            </td>
            <td>
                &euro; <?= number_format($employee['salary'],2,",",".")?>,-
            </td>
        </tr>
    <?php
        $total_salary += $employee['salary'];
        $total_working_hours += $employee['total_hours'];
    ?>
    <?php endforeach;?>
    <tr>
        <td colspan="5" >
            <div class="d-flex align-items-center justify-content-center">
                <div class="me-3">Totale gewerkte uren:</div>
                <div class="mx-3">
                    <?= round($total_working_hours,2)?>
                </div>
                |
                <div class="mx-3">Totale salaries:</div>
                <div class="mx-3">
                    &euro; <?= number_format($total_salary,2,",",".")?>,-
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>

<?php
include_once ('../Templates/defaults/footer.php');
?>

</body>
</html>