<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
?>
<body>
<style>
    .bg-img{
        background: url("/img/register3.png");
        background-size: cover;
    }
    .v-line{
        width: .5%;
        height: 90%;
        background-color: lightgrey !important;
        position: absolute;
        border-radius: 20px;
    }
</style>
<?php
if(isset($_SESSION['member']) && !empty($_SESSION['member'])){
    include_once ('defaults/userNavbar.php');
}else{
    include_once ('defaults/navbar.php');
}
global $msg;
if (isset($msg)){
    echo $msg;
}
?>
<div class="container bg-img card text-black" style="border-radius: 25px">
    <div class="row">
        <div class="d-flex flex-lg-row flex-column justify-content-center justify-content-lg-around align-items-center my-3">
            <div
                    style="background: rgba(116, 116, 116, 0.38)"
                    class="shadow my-3 p-lg-0 p-5 my-lg-0 rounded-3 col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1"
            >
                <p
                        class="text-center text-white text-uppercase h1 fw-bold mb-5 mx-1 mx-md-4 pt-4"
                >
                    AANMELDEN
                </p>
                <form method="post" class="mx-1 mx-md-4">
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input
                                    type="text"
                                    id="voornaam"
                                    name="voornaam"
                                    class="form-control"
                            />
                            <label class="form-label text-white" for="voornaam"
                            >Voornaam</label
                            >
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input
                                    type="text"
                                    id="achternaam"
                                    name="achternaam"
                                    class="form-control"
                            />
                            <label class="form-label text-white" for="achternaam"
                            >achternaam</label
                            >
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input type="text" id="email" name="email" class="form-control" />
                            <label class="form-label text-white" for="email">Email</label>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input
                                    type="password"
                                    id="form3Example4c"
                                    name="wachtwoord"
                                    class="form-control"
                            />
                            <label class="form-label text-white" for="wachtwoord"
                            >Wachtwoord</label
                            >
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input
                                    type="password"
                                    id="form3Example4cd"
                                    name="wachtwoordcheck"
                                    class="form-control"
                            />
                            <label class="form-label text-white" for="wachtwoordcheck"
                            >Herhaal uw wachtwoord</label
                            >
                        </div>
                    </div>
                    <div class="form-check d-flex justify-content-center mb-5">
                        <input
                                class="form-check-input me-2"
                                type="checkbox"
                                name="checkbox"
                                value=""
                                id="checkbox"
                        />
                        <label class="text-white form-check-label" for="checkbox">
                            I agree all statements in
                            <a class="text-danger" href="#!">Terms of service</a>
                        </label>
                    </div>
                    <div class="d-flex justify-content-center mx-4 pb-5 mb-lg-4">
                        <input
                                type="submit"
                                name="submit"
                                class="btn btn-danger btn-lg"
                                value="Registreer"
                        />
                    </div>
                </form>
            </div>
            <div class="d-none d-lg-block v-line">
            </div>
            <div
                    style="background: rgba(116, 116, 116, 0.38)"
                    class="shadow my-3 my-lg-0 rounded-3 p-5 p-lg-0 col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1"
            >
                <p
                        class="text-center text-white text-uppercase h1 fw-bold mb-5 mx-1 mx-md-4 pt-4"
                >
                    INLOGGEN
                </p>
                <form method="post" class="mx-1 mx-md-4">
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input
                                    type="text"
                                    id="singing_email"
                                    name="userEmail"
                                    class="form-control"
                            />
                            <label class="form-label text-white" for="singing_email"
                            >Email</label
                            >
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <input
                                    type="password"
                                    id="password"
                                    name="userPassword"
                                    class="form-control"
                            />
                            <label class="form-label text-white" for="password"
                            >Password</label
                            >
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mx-4 pb-5 mb-lg-4">
                        <input
                                type="submit"
                                name="verzenden"
                                class="btn btn-danger btn-lg"
                                value="Inloggen"
                        />
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