<header class="mb-5 mt-3">
    <div class="container-fluid">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgba(24,21,21,0)">
                <div class="container-fluid">
                    <a class="navbar-brand ps-lg-5 ms-lg-5" href="/member/home">
                        <img class="logo img-fluid" src="/img/logo2.png" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active fs-3 main  main-font mx-5 neonText" href="/member/home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active fs-3 main main-font mx-5 neonText" href="/member/categories">Auto's</a>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="nav-link active fs-3 main main-font mx-5 neonText dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i>
                                        <?php
                                        // session from Modules->login->login().
                                        //session wordt gevuld met gegevens wanneer de gebruiker zich aanmeldt
                                        echo ucfirst($_SESSION['UFName']) ." ". ucfirst(  $_SESSION['ULName'])
                                        ?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="/member/profile">Gegevens</a></li>
                                        <li><a class="dropdown-item" href="/logout">Uitloggen <i class="bi bi-box-arrow-right"></i></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>