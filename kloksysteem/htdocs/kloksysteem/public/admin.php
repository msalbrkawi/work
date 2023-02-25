<?php
global $params;

//check if user has role admin
if (!isAdmin()) {
    logout();
    header ("location:/inloggen");
} else {
/* $params[2] is de action
   $params[3] is een getal die de delete action nodig heeft
*/
    switch ($params[2]) {

        case 'dashboard':
            $titleSuffix = ' | Dashboard';
            include_once "../Templates/admin/dashboard.php";
            break;

        case 'werknemmers':
            $titleSuffix = ' | Dashboard';
            $employees = getEmployees($_SESSION['AId']);
            include_once "../Templates/admin/employees.php";
            break;

        case 'werknemer':
            $titleSuffix = ' | werknemer';
            $employee = getEmployee($params[3]);
            if (checkUser() == true){
                updateEmployee($params[3]);
                header('location: /admin/dashboard');
            }
            include_once "../Templates/admin/employee.php";
            break;

        case 'werknemmer_toeveogen':
            $titleSuffix = ' | werknemmer toeveogen';
            if (checkUser() == true){
                registerUser();
            }
            include_once "../Templates/admin/addEmployee.php";
            break;

        case 'overzicht':
            $titleSuffix = ' | Overzicht';
            overzicht();
            if (isset($_SESSION['salary_id'])){
                employeeStop($_SESSION['salary_id']);
            }
            employeeStart();
            $salary = getSalary();
            include_once "../Templates/admin/overzicht.php";
            break;

        case 'carsBeheer':
            $titleSuffix = ' | carsBeheer';
            $cars = getCars();
            include_once "../Templates/admin/carsBeheer.php";
            break;

        case 'addCar':
            $titleSuffix = ' | insertCar';
            $cars= getCategories();
            if (insertCarBtn() == true){
                insertCar();
                header('Location: /admin/carsBeheer');
            }
            include_once "../Templates/admin/insertCar.php";
            break;

        case 'deleteCar':
            deletetCar($params[3]);
            include_once "../Templates/admin/deleteCar.php";
            break;

        case 'updateCar':
            $titleSuffix = ' | categoryUpdate';
            $cars= getCategories();
            $car = getCar($params[3]);
            if (checkBtn() == true){
                $result = updateCar($params[3]);
                header('Location: /admin/carsBeheer');
            }
            include_once "../Templates/admin/carUpdate.php";
            break;

        case 'categorieBeheer':
            $titleSuffix = ' | categorieBeheer';
            $categories = getCategories();
            include_once "../Templates/admin/categorieBeheer.php";
            break;

        case 'cars':
            $titleSuffix = ' | cars';
            $categoriesCar= categoriesCar($params[3]);
            include_once "../Templates/admin/cars.php";
            break;

        case 'addcategorie':
            $titleSuffix = ' | Insert Categorie';
            if (inserCategoryBtn() == true){
                insertCategorie();
                header('Location: /admin/categorieBeheer');
            }
            include_once "../Templates/admin/insertCategorie.php";
            break;

        case 'deletecategorie':
            deletetCategorie($params[3]);
            include_once "../Templates/admin/deleteCategorie.php";
            break;

        case 'updatecategory':
            $titleSuffix = ' | categoryUpdate';
            if (udateCategoryBtn() == true){
                $result = updateCategorie($params[3]);
                header('Location: /admin/categorieBeheer');
            }
            $categoryName = getCategoryName($params[3]);
            include_once "../Templates/admin/categoryUpdate.php";
            break;

        case 'profile':
            $titleSuffix = ' | Profile';
            $users = getUser($_SESSION['UId']);
            include_once "../Templates/admin/gegevens.php";
            break;

        case 'editprofile':
            $titleSuffix = ' | Edit Profile';
            $users = getUser($_SESSION['UId']);
            if (updateUserBtn() === true){
                updateUser($_SESSION['UId']);
                header('location: /admin/home');
            }
            include_once "../Templates/admin/updateUser.php";
            break;

        case 'changepassword':
            $titleSuffix = ' | Change Password';
            updatePasswordCheck();
            include_once ('../Templates/admin/updatePassword.php');
            break;

        case 'categories':
            $titleSuffix = ' | Categories';
            $categories = getCategories();
            include_once "../Templates/admin/categories.php";
            break;

        case 'category':
            $titleSuffix = ' | category';
            $categoryName = getCategoryName($params[3]);
            $result=getCategory($params[3]);
            include_once "../Templates/admin/category.php";
            break;

        case 'car':
            $titleSuffix = ' | car';
            if (checkReview() == true){
                addReview();
            }
            $car = getCar($params[3]);
            $review = getReview($params[3]);
            include_once "../Templates/admin/car.php";
            break;

        default:
            header("location: /inloggen");
            break;
    }
}