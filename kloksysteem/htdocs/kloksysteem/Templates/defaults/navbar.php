<header>
    <div class="container-fluid">
        <div class="col-12">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgba(24,21,21,0)">
        <div class="container-fluid">
            <a class="navbar-brand ps-lg-5 ms-lg-5" href="/admin/dashboard">
                <img class="logo img-fluid" width="125px" src="/img/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <?php
                if (isset($_SESSION['Aname'])){
                    echo '
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/overzicht">Overzicht</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/admin/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/logout">Uitloggen</a>
                    </li>
                </ul>                                      
                                    ';
                }else{
                    echo '
                    <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/inloggen">Inloggen</a>
                    </li>
                </ul>   
                    ';
                }
                ?>
            </div>
        </div>
    </nav>
        </div>
    </div>
</header>