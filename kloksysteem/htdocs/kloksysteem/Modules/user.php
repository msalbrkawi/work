<?php

function getUser($id):array
{
    $db = new PDO("mysql:host=localhost;dbname=superride","root","");
    $query = $db->prepare("SELECT * FROM user WHERE  id= :id");
    $query->bindParam("id",$id);
    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    return  $users;
}

function updateUserBtn(){
    global $msg,$firstname,$lastname;
    if (isset($_POST['submit'])){
        if (!empty($_POST['fname'])&&!empty($_POST['lname'])){
            $firstname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_STRING);
            $lastname= filter_input(INPUT_POST, "lname", FILTER_SANITIZE_STRING);
//            $email= filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                return true;
        }
        else{
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Vul alles in!</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
            return false;
        }
    }
}

function updateUser($id){
    global $firstname,$lastname,$email;
    $db = new PDO("mysql:host=localhost;dbname=superride","root","");
    $query = $db->prepare("UPDATE user SET fname = :fname, lname = :lname WHERE id = :id");
    $query->bindParam("fname", $firstname);
    $query->bindParam("lname", $lastname);
    $query->bindParam("id", $id);
    $users = $query->execute();
    $_SESSION['UFName'] = $firstname;
    $_SESSION['ULName'] = $lastname;
    return $users;
}

function updatePasswordCheck(){
    if (isset($_POST['submit'])){
        global $msg;
        if (!empty($_POST['oldPassword'])&&!empty($_POST['confirmPassword'])&&!empty($_POST['newPassword'])){
//                    session from Modules->login.php->login().
            $vpassword = password_verify($_POST['oldPassword'], $_SESSION['UPassword']);
            if ($vpassword>0){
                if ($_POST['newPassword']===$_POST['confirmPassword']){
//                    session from Modules->login.php->login().
                    $id = $_SESSION['UId'];
                    $db = new PDO("mysql:host=localhost;dbname=superride","root","");
                    $query = $db->prepare("UPDATE user SET password = :password WHERE id = :id");
                    $hashedPassword = password_hash($_POST['confirmPassword'],PASSWORD_DEFAULT);
                    $query->bindParam("password", $hashedPassword);
                    $query->bindParam("id", $id);
                    $query->execute();
//                    session from Modules->login.php->login().
                    $_SESSION['UPassword']=$hashedPassword;
                    $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>wachtwoord is gewijzigd</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    $_SESSION['msg'] = $msg;
                    if (isAdmin()==true){
                        header("location: /admin/home");
                    }else if (isMember()==true){
                        header("location: /member/home");
                    }

                }else{
                    $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>wachtwoorden komen niet overeen !</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
            }else{
                $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Wachtwoord klopt niet!</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
            }
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Vull alles in!</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        }
    }
}

?>