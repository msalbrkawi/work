<!DOCTYPE html>
<html>
<?php
include_once('defaults/head.php');
?>
<body>
<?php
    include_once ('defaults/navbar.php');
?>
<div class="container-fluid px-5">


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="neonText main-font" href="/home">Home</a></li>
            <li class="breadcrumb-item"><a class="neonText main-font" href="/categories">Categories</a></li>
            <li class="breadcrumb-item"><a class="neonText main-font" href="/category/<?php global $params; echo $_SESSION['params']?>"><?php echo ucfirst($_SESSION['categoryName'])?></a></li>
            <?php global $car,$params ?>
            <?php foreach ($car as $item): ?>
                <li class="breadcrumb-item"><a class="neonText main-font" href="/car/<?php global $params; echo $params[2]?>"><?php echo ucfirst($item['name']) ?></a></li>
            <?php endforeach; ?>
        </ol>
    </nav>
    <br>
    <div class="row gy-3 " style="background:rgba(252,1,57,0.4);" >
        <!--    Mohammad    -->
        <?php global $car,$params ?>
        <?php foreach ($car as $item): ?>
            <div class="d-lg-flex align-items-center">
                <div class="col-12 col-lg-6 ">
                    <div class="card " style="background:rgba(252,1,57,0);">
                        <img class="card-img-top img-fluid  mx-auto my-1 rounded" src='/img/cars/<?= $item['img'] ?>'/>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card-body">
                        <h1 class=" display-4 card-title mb-3 text-white text-center" style="font-family: kenteken">#*<?= ucfirst($item['name'])?>)</h1>
                        <hr>
                        <p class="text-light  card-text fs-3 w-75 mx-auto" style="font-family: test rg"><?= $item['description']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!--    Mohammad    -->
    </div>
    <hr>
    <!--    Mohammad-->

    <!--    add review test-->
    <!-- Button trigger modal -->
<!--    --><?php
//    if(isset($_SESSION['member']) && !empty($_SESSION['member'])){
//    echo '
//    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
//        <i class="bi bi-plus-circle"></i> review toevoegen
//    </button>
//
//    ';}
//    ?>


    <!-- Modal -->
<!--    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--        <div class="modal-dialog">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header">-->
<!--                    <h5 class="modal-title" id="exampleModalLabel">Review </h5>-->
<!--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <form method="post" >-->
<!--                        <div class="form-outline mb-4 ">-->
<!--                        <label for="review" class="text-neon" style="font-family: aharoni">Review: </label>-->
<!--                        <input type="text" name="review" id="review" class="form-control">-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label for="stars" style="font-family: aharoni">Stars</label>-->
<!--                            <select class="mb-4 form-control"  id="stars" name="stars">-->
<!--                                <option value=""></option>-->
<!--                                <option value="1">1</option>-->
<!--                                <option value="2">2</option>-->
<!--                                <option value="3">3</option>-->
<!--                                <option value="4">4</option>-->
<!--                                <option value="5">5</option>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <input type="submit" class="ms-auto btn btn-primary" name="verzenden">-->
<!--                            <input type="button" class="ms-auto btn btn-secondary" data-bs-dismiss="modal" value="Close">-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="my-3">
    </div>
    <div class="row">
    <?php global $review?>
    <?php foreach ($review as $item): ?>
        <div class="col-12 my-3 col-lg-3">
            <div style="background:white;" class="rounded ">
                <div class="card-body ">
                   <div class="d-flex card-title"><h1 class="main-font card-title text-black text-center fs-5"  ><?= ucfirst($item['fname']);?> <?= ucfirst($item['lname']);?> </h1><div class="text-dark card-text mx-4">(<?= $item['date']?>)</div></div>
                    <hr>
                    <p class="text-dark card-text  mx-auto " style="font-size: 20px "><?= $item['review']?></p>
                    <br>
                <footer class="blockquote-footer"><?=$item['stars']?> &starf;<cite title="Source Title"></cite> </footer>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
include_once('defaults/footer.php');

?>
</body>
</html>

