<?php
require '../Modules/login.php';
require '../Modules/logout.php';
require '../Modules/database.php';
require '../Modules/common.php';
require '../Modules/reviews.php';
require '../Modules/user.php';
require '../Modules/employee.php';
session_start();
//var_dump($_SESSION);
//var_dump($_POST);
$message="";

$request = $_SERVER['REQUEST_URI'];

$params = explode("/", $request);
//print_r($request);
$title = "Sam Döner Express";
$titleSuffix = "";

//$params[1] is de action
//$params[2] is een extra getal die de action nodig heeft om zijn taak uit te voeren
switch ($params[1]) {

    case 'home':
        $titleSuffix = ' | Home';
        include_once "../Templates/home.php";
        break;

    case 'categories':
        $titleSuffix = ' | Categories';
        $categories = getCategories();
        //var_dump($categories);die;
        include_once "../Templates/categories.php";
        break;

    case 'category':
        $titleSuffix = ' | category';
        $categoryName = getCategoryName($params[2]);
        $result=getCategory($params[2]);
        include_once "../Templates/category.php";
        break;

    case 'car':
        $titleSuffix = ' | car';
        if (checkReview() == true){
            addReview();
        }
        $car = getCar($params[2]);
        $review = getReview($params[2]);
        include_once "../Templates/car.php";
        break;

    case 'inloggen':
        if (checkLogin() == true){
            login();
            if (login()==true){
                if ( isAdmin()==true){
                    header("location: /admin/dashboard");
                }
            }
        }
        $titleSuffix = ' | Inloggen';
        include_once "../Templates/inloggen.php";
        break;

    case 'registreren':
        if (checkUser() == true){
            registerUser();
        }
        $titleSuffix = ' | registreren';
        include_once "../Templates/registreren.php";
        break;


    case 'admin':
        include_once ('admin.php');
        break;

    case 'member':
        include_once ('member.php');
        break;

    case 'logout':
        logout();
        header("location: /inloggen");
        break;

    default:
        $titleSuffix = ' | Inloggen';
        header("location: http://kloksysteem.localhost/inloggen");
}







