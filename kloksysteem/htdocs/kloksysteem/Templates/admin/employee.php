<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');
include_once('../Templates/defaults/navbar.php');
?>
<body>
<div class="ms-1 mb-5">
    <a class="text-black" href="/admin/dashboard">Dashboard</a> / <a class="text-black" href="/admin/werknemmers">Werknemmers</a>
</div>
<div class="container">
    <div class="d-flex justify-content-center align-items-center flex-column" style="height: 80vh;">
        <div class="row">
            <div class="col-12" style="width: 60vw;">
                <?php global $msg; if (isset($msg)){
                    echo $msg;
                }?>
            </div>
        </div>
        <div class="row p-5 container-shadow" style="border: 1px solid black; border-radius: 10px;width: 50vw;">
            <div class="col-12">
                <form method="post">
                    <?php global $employee; foreach ($employee as $data):?>
                    <div style="width: 100%;">
                        <label class="col-form-label" for="employee_first_name">Voornaam:</label>
                        <br>
                        <input class="form-control mb-2 px-2 input-shadow w-100" placeholder="Piet" type="text" name="employee_first_name" id="employee_first_name" value="<?= $data['employee_first_name']?>" style="border-radius: 10px">
                    </div>
                    <div style="width: 100%;">
                        <label class="col-form-label" for="employee_last_name">Achternaam:</label>
                        <br>
                        <input class="form-control mb-2 px-2 input-shadow w-100" placeholder="Achternaam" type="text" name="employee_last_name" id="employee_last_name" value="<?= $data['employee_last_name']?>" style="border-radius: 10px">
                    </div>
                    <div style="width: 100%;">
                        <label class="col-form-label" for="employee_hire_date">Hire date:</label>
                        <br>
                        <input class="form-control mb-2 px-2 input-shadow w-100" type="date" name="employee_hire_date" id="employee_hire_date" value="<?= $data['hire_date']?>" style="border-radius: 10px">
                    </div>
                    <div style="width: 100%;">
                        <label class="col-form-label" for="employee_email">Email:</label>
                        <br>
                        <input class="form-control mb-2 px-2 input-shadow w-100" placeholder="someone@example.com" type="text" name="employee_email" id="employee_email" value="<?= $data['employee_email']?>" style="border-radius: 10px">
                    </div>
                    <div style="width: 100%;">
                        <label class="col-form-label" for="employee_phone_number">Telefoonnummer:</label>
                        <br>
                        <input class="form-control mb-2 px-2 input-shadow w-100" placeholder="06 12345678" type="text" name="employee_phone_number" id="employee_phone_number" value="<?= "0".$data['employee_telefoon']?>" style="border-radius: 10px">
                    </div>
                    <div style="width: 100%;">
                        <label class="col-form-label" for="employee_Uurloon">Uurloon:</label>
                        <br>
                        <input class="form-control mb-2 px-2 input-shadow w-100" placeholder="6.67" type="text" name="uurloon" id="Uurloon" value="<?= $data['uurloon']?>" style="border-radius: 10px">
                    </div>
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-center">
                        <input class="mt-3 input-shadow btn px-5" type="submit" name="submit" value="Submit" style="border: 1px #ced4da solid; border-radius: 10px">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once ('../Templates/defaults/footer.php');
?>
</body>
</html>