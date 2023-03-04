<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');
include_once('../Templates/defaults/navbar.php');
?>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Naam:</th>
    </tr>
    </thead>
    <tbody>
    <?php global $employees; foreach ($employees as $employee): ?>
    <tr>
        <td>
            <a class="text-dark" href="/admin/werknemer_werk_uren/<?= $employee['employee_id']?>"><?= $employee['employee_first_name']."  ".$employee['employee_last_name']?></a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
include_once ('../Templates/defaults/footer.php');
?>

</body>
</html>