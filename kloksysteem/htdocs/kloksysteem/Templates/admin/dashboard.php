<!DOCTYPE html>
<html>
<?php
include_once('../Templates/defaults/head.php');
include_once('../Templates/defaults/navbar.php');
?>
<body>

<div class="container">
    <h1 class="display-1">Goedemorgen <?= ucfirst($_SESSION['Aname'])?>,</h1>
    <div class="row">
        <div class="col-12" style="width: 60vw;">
            <?php if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                $_SESSION['msg'] = NULL;
            }?>
        </div>
    <div class="row mt-2">
        <div class="col-lg-6 col-12 my-3">
            <a href="/admin/werk_uren" class="text-black text-decoration-none">
                <div class="card input-shadow" style="height: 15rem">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="card-title d-flex align-items-center">
                            <i class="bi bi-file-earmark-bar-graph  me-2 text-black fs-1"></i>
                            <h5>Werk uren</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-12 my-3">
            <a href="/admin/werknemmers" class="text-black text-decoration-none">
                <div class="card input-shadow" style="height: 15rem">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="card-title d-flex align-items-center">
                            <i class="bi bi-people me-2 text-black fs-1"></i>
                            <h5>Werknemmers</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row justify-content-lg-center">
        <div class="col-lg-6 col-12 my-3">
            <a href="/admin/werknemmer_toeveogen" class="text-black text-decoration-none">
                <div class="card input-shadow" style="height: 15rem">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="card-title d-flex align-items-center">
                            <i class="bi bi-person-add me-2 text-black fs-1"></i>
                            <h5>Medewerker toevoegen</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>


<?php
include_once ('../Templates/defaults/footer.php');
?>
</body>
</html>