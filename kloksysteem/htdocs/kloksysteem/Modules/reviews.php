<?php

function getReview($id):array
{
    $db = new PDO("mysql:host=localhost;dbname=superride","root","");
//    $query = $db->prepare("SELECT * FROM review as r,user as u WHERE u.id=r.user_id  and r.car_id = :id");
    $query = $db->prepare("SELECT * 
FROM review
INNER JOIN user
ON user.id = review.user_id
where car_id = :id
order by review.date
");
    $query->bindParam("id",$id);
    $query->execute();
    $review = $query->fetchAll(PDO::FETCH_ASSOC);

    return  $review;
}

function checkReview()
{
    global $msg, $review,$stars ;
    if (isset($_POST['verzenden'])) {
        if ( !empty($_POST['review']) && !empty($_POST['stars'])) {
            $review = filter_input(INPUT_POST, "review", FILTER_SANITIZE_STRING);
            $stars = filter_input(INPUT_POST, "stars", FILTER_VALIDATE_INT);

           return true;
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Let op!</strong> Het review is niet verzonden omadet het niet helemaal ingevuld is.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';

            return false;
        }
    }
return false;
}

function addReview(){
    global $review,$stars,$params;
    $date = date("o-m-d");
    $car_id = $params[3];
//    session from Modules->login.php->login().
    $user_id = $_SESSION['UId'];
    $db = new PDO("mysql:host=localhost;dbname=superride", "root", "");
    $query = $db->prepare("INSERT INTO review(date, review, stars, user_id, car_id) VALUES(:date, :review, :stars, :user_id, :car_id)");
    $query->bindParam("review", $review);
    $query->bindParam("stars", $stars);
    $query->bindParam("user_id", $user_id);
    $query->bindParam("car_id", $car_id);
    $query->bindParam("date", $date);
    if ($query->execute()){
        header("location: /member/car/".$car_id."");
    }


}
