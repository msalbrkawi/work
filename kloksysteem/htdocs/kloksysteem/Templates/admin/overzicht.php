<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');
include_once('../Templates/defaults/navbar.php');
?>
<style>
    .rounded-btn{
        border-radius: 50% !important;
        border: 1px black solid !important;
        transition: all .4s;
    }
    .rounded-btn:hover{
        background: black !important;
        color: white;
    }
</style>
<body>

<div class="container">

    <div class="row">
        <div class="col-xxl-6 col-12 my-3 d-flex flex-column justify-content-center align-items-center">
            <form method="post">
                <input class="form-control mb-5 py-3 fs-1 container-shadow" style="border-radius: 20px; border: 1px solid black" placeholder="1234" id="tbInput" autocomplete="off" name="inputCode" type="text"/>
                <div id="VirtualKey" class="p-3 container-shadow text-center" style="border: 1px solid black; border-radius: 20px;">
                    <input id="btn1" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="1" type="button" onclick="input(this);" />
                    <input id="btn2" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="2" type="button" onclick="input(this);" />
                    <input id="btn3" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="3" type="button" onclick="input(this);" />
                    <br />
                    <input id="btn4" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="4" type="button" onclick="input(this);" />
                    <input id="btn5" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="5" type="button" onclick="input(this);" />
                    <input id="btn6" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="6" type="button" onclick="input(this);" />
                    <br />
                    <input id="btn7" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="7" type="button" onclick="input(this);" />
                    <input id="btn8" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="8" type="button" onclick="input(this);" />
                    <input id="btn9" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="9" type="button" onclick="input(this);" />
                    <br />
                    <input id="btn0" class="btn m-2 input-shadow rounded-btn bg-white p-4" value="0" type="button" onclick="input(this)" />
                    <button id="btnDel" name="submit" style="border: 1px solid black; border-radius: 20px;" class= "ms-3 btn input-shadow" type="button" onclick="del();"><i class="bi bi-backspace"></i></button>
                    <input type="submit" class="ms-3 btn input-shadow" style="border: 1px solid black; border-radius: 20px;" name="submit" value="Enter">
                </div>
            </form>
        </div>
        <div class="col-xxl-6 col-12 my-3 p-5 container-shadow" style="border: 1px solid black; border-radius: 20px;">
            <?php global $salary; foreach ($salary as $data):?>
            <div class="employee p-3 " style="border: 1px solid black; border-radius: 7px">
                <div class="row justify-content-between align-items-center">
                    <div class="col-3">Naam:</div>
                    <div class="col-3">Gestaart om:</div>
                    <div class="col-3">Gestopt om:</div>
                    <div class="col-3">Status:</div>
                </div>
                <div class="row">
                    <div class="col-3"><?= $data['employee_first_name']. " " .$data['employee_last_name']?></div>
                    <div class="col-3"><?= str_replace(":00","",$data['start_date'])?></div>
                    <div class="col-3"><?php
                        if (!$data['end_date']){
                            echo "--:--";
                        }else{
                            echo str_replace(":00","",$data['end_date']);
                    }

                        ?></div>
                    <div class="col-3"><?= $data['status']?></div>
                </div>
            </div>
<!--            --><?php
//
//                $str = str_replace(":", ".", $data['start_date']);
//                $float_value = floatval($str);  // this Line Convertit une chaîne en nombre à virgule flottante
//
//                echo $float_value + 1;
//
//                ?>
            <?php endforeach;?>
        </div>
    </div>

</div>

<dialog class="start" style="width: 70vw;">
        <div>
            <div class="modal-content" style="70vw">
                <div class="modal-header">
                    <h5 class="modal-title me-5">Hello, <?php global $employee;  echo $employee['employee_first_name'] . " " . $employee['employee_last_name']?></h5>
                    <button type="button" class="btn-close close-btn"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input class="w-100" type="time" name="startTime" id="id" value="<?= date('h:i')?>">
                </div>
                <div class="modal-footer">
                    <input type="submit" name="start" value="Inklokken" class="btn btn-primary">
                </div>
                </form>
            </div>
    </div>
</dialog>

<dialog class="stop" style="width: 70vw;">
    <div>
        <div class="modal-content" style="70vw">
            <div class="modal-header">
                <h5 class="modal-title me-5">Hello, <?php global $employee;  echo $employee['employee_first_name'] . " " . $employee['employee_last_name']?></h5>
                <button type="button" class="btn-close close-btn"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div>
                        <label for="start_time">Gestart om:</label>
                        <input class="w-100" type="time" name="startTime" id="start_time" value="<?= str_replace(":00","",$_SESSION['salaryWithCode']['start_date'])?>
">
                    </div>
                    <div>
                        <label for=end_time">Stopeen om:</label>
                        <input class="w-100" type="time" name="startTime" id="end_time" value="<?= date('h:i')?>">
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" name="end" value="Uitklokken" class="btn btn-primary">
            </div>
            </form>
        </div>
    </div>

    </dialog>


<?php global $msg; if (isset($msg)){
    echo $msg;
}?>

    <?php
    include_once ('../Templates/defaults/footer.php');
    ?>

<script>
    const startDia = document.querySelector('.start');
    const endDia = document.querySelector('.stop');
    const btns = document.querySelectorAll('.close-btn');
    btns.forEach(btn => {
        btn.addEventListener("click", (e) => {
            startDia.close();
            endDia.close();
        })
    })
    <?php global $script; if (isset($script)){
        echo $script;
    }?>
    function input(e) {
        var tbInput = document.getElementById("tbInput");
        tbInput.value = tbInput.value + e.value;
    }
    function del() {
        var tbInput = document.getElementById("tbInput");
        tbInput.value = tbInput.value.substr(0, tbInput.value.length - 1);
    }
</script>
</body>
</html>