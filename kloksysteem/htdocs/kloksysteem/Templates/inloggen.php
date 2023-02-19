<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
include_once('defaults/navbar.php');
?>
<body>

<div class="container">
    <div class="d-flex justify-content-center align-items-center flex-column" style="height: 60vh;">
        <div class="row">
            <div class="col-12" style="width: 60vw;">
                <?php global $msg; if (isset($msg)){
                    echo $msg;
                }?>
            </div>
        </div>
        <div class="row p-5 container-shadow" style="border: 1px solid black; border-radius: 10px">
            <div class="col-12">
                <h1 class="text-center">Inloggen</h1>
                <form method="post">
                    <div style="width: 50vw;">
                        <label class="col-form-label" for="email">Email:</label>
                        <br>
                        <input class="form-control mb-2 px-2 input-shadow w-100" placeholder="someone@example.com" type="text" name="email" id="email" style="border-radius: 10px">
                    </div>
                    <div style="width: 50vw;">
                        <label class="col-form-label" for="password">Password:</label>
                        <br>
                        <input class="form-control mb-2 px-2 input-shadow w-100" placeholder="********" type="password" name="password" id="password" style="border-radius: 10px">
                    </div>
                    <div class="d-flex justify-content-center">
                        <input class="mt-3 input-shadow btn px-5" type="submit" name="submit" value="Submit" style="border: 1px #ced4da solid; border-radius: 10px">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include_once ('defaults/footer.php');
?>
</body>
</html>