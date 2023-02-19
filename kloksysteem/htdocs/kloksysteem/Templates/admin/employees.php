<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');
include_once('../Templates/defaults/navbar.php');
?>
<body>

<div class="container mt-5">

<table class="table table-striped" style="border: 1px black solid">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Naam:</th>
        <th scope="col">Telefoon:</th>
        <th scope="col">Code:</th>
    </tr>
    </thead>
    <tbody>
    <?php
    global $employees;
    $i = 1;
    ?>
    <?php foreach ($employees as $employee): ?>
    <tr>
        <th scope="row"><?= $i;?></th>
        <td><a class="text-dark" href="/admin/werknemer/<?= $employee['employee_id']?>"><?= $employee['employee_first_name']."  ".$employee['employee_last_name']?></a></td>
        <td><?= "0".$employee['employee_telefoon']?></td>
        <td><?= $employee['code']?></td>
    </tr>
    <?php
    $i++;
    endforeach; ?>
    </tbody>
</table>

</div>

    <?php
    include_once ('../Templates/defaults/footer.php');
    ?>
</body>
</html>