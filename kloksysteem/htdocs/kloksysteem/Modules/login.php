<?php

function checkLogin(){
    global $msg, $password, $email;
    if (isset($_POST['submit'])) {
        if ( !empty($_POST['email']) && !empty($_POST['password'])) {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
            if ($email == false || $password == false){
                $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Let op!</strong> het Email of wachtwoord kloppen niet .
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                return false;
            }else{
                return true;
            }
        }else{
            $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Let op!</strong> Vul alles in.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        }
    }



}

function login()
{
    global  $email, $password, $msg;
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem", "root", "");
    $query = $db->prepare("SELECT * from admin ");
    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user){
        $vpassword = password_verify($password, $user['password']);
        if ($user['email']==$email&&$vpassword){
            $_SESSION['user'] = $user['role'];
            $_SESSION['Aname'] = $user['name'];
            $_SESSION['AId'] = $user['id'];
//            $_SESSION['UPassword'] = $user['password'];
//            $_SESSION['user'] = [$user['name'], $user['role']];
            return true;
        }
    }
    $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Let op!</strong> Email of password kloppen niet.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
    return  false;
}

function isAdmin():bool
{
    //controleer of er ingelogd is en de user de rol admin heeft
    if(isset($_SESSION['user'])&&!empty($_SESSION['user']))
    {
        $user=$_SESSION['user'];
        if ($user === "admin")
        {
            $_SESSION['admin'] = $user;
            return true;
        }
        else
        {
            return false;
        }
    }
    return false;
}

