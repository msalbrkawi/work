<?php
$db = new PDO("mysql:host=localhost;dbname=kloksysteem", "root", "");

// register
function checkUser()
{
    global $msg,$e_f_name,$e_l_name,$e_hire_date,$e_email,$e_telefoon,$e_u_loon;
    if (isset($_POST['submit'])) {
        if (!empty($_POST['employee_first_name']) && !empty($_POST['employee_last_name']) && !empty($_POST['employee_hire_date']) && !empty($_POST['employee_email']) && !empty($_POST['employee_phone_number']) && !empty($_POST['uurloon'])) {
            $e_f_name = filter_input(INPUT_POST, "employee_first_name", FILTER_SANITIZE_STRING);
            $e_l_name = filter_input(INPUT_POST, "employee_last_name", FILTER_SANITIZE_STRING);
            $e_hire_date = filter_input(INPUT_POST, "employee_hire_date");
            $e_email = filter_input(INPUT_POST, "employee_email", FILTER_VALIDATE_EMAIL);
            $e_telefoon = filter_input(INPUT_POST, "employee_phone_number", FILTER_VALIDATE_FLOAT);
            $e_u_loon = filter_input(INPUT_POST, "uurloon", FILTER_VALIDATE_FLOAT);
            if ($e_email == true){
                if ($e_telefoon){
                    if ($e_u_loon == true){
                        return true;
                    }
                    else{
                        $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Let op!</strong> Vul een bedrag in.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                }
                else{
                    var_dump($e_telefoon === true);
                    $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Let op!</strong> Vul een gelidge telefoonnummer in.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
            }else{
                $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Let op!</strong> Vul een geldige email in.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
            }
        }else{
            $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Let op!</strong> Vul alles in.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        }
    }
    return false;
}

function registerUser()
{
    $code = random_int(1111,9999);
    global $msg,$e_f_name,$e_l_name,$e_hire_date,$e_email,$e_telefoon,$e_u_loon, $db;
    $query = $db->prepare("INSERT INTO employee(employee_first_name,employee_last_name,hire_date,employee_email,employee_telefoon,uurloon, code, manger_id)
    VALUES
    (:employee_first_name, :employee_last_name, :hire_date, :employee_email, :employee_telefoon, :uurloon, :code, :manger_id)");
    $query->bindParam("employee_first_name", $e_f_name);
    $query->bindParam("employee_last_name", $e_l_name);
    $query->bindParam("hire_date", $e_hire_date);
    $query->bindParam("employee_email", $e_email);
    $query->bindParam("employee_telefoon", $e_telefoon);
    $query->bindParam("uurloon", $e_u_loon);
    $query->bindParam("code", $code);
    $query->bindParam("manger_id", $_SESSION['AId']);
    if ($query->execute()){
        $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Registreren is gelukt.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        header("location: /admin/dashboard");
    }
    else{
        $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Let op!</strong> Registreren is niet gelukt.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
    }
}
// register

// printEmployees
function getEmployees($id):array
{
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
//    $query = $db->prepare("SELECT * FROM review as r,user as u WHERE u.id=r.user_id  and r.car_id = :id");
    $query = $db->prepare("SELECT * FROM employee where manger_id = :id order by employee_first_name, employee_last_name");
    $query->bindParam("id", $id);
    $query->execute();
    $employees = $query->fetchAll(PDO::FETCH_ASSOC);

    return  $employees;
}
// printEmployees

// printEmployee
function getEmployee($id):array
{
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
    $query = $db->prepare("SELECT * FROM employee where employee_id=:id");
    $query->bindParam("id",$id);
    $query->execute();
    $employee = $query->fetchAll(PDO::FETCH_ASSOC);

    return  $employee;
}

// printEmployee

// UpdateEmployee

function updateEmployee($id)
{
    global $msg,$e_f_name,$e_l_name,$e_hire_date,$e_email,$e_telefoon,$e_u_loon, $db;
    $query = $db->prepare("UPDATE employee
SET employee_first_name = :employee_first_name, employee_last_name = :employee_last_name, employee_email = :employee_email, employee_telefoon = :employee_telefoon,
    uurloon = :uurloon
WHERE employee_id = :id");
    $query->bindParam("id", $id);
    $query->bindParam("employee_first_name", $e_f_name);
    $query->bindParam("employee_last_name", $e_l_name);
    $query->bindParam("employee_email", $e_email);
    $query->bindParam("employee_telefoon", $e_telefoon);
    $query->bindParam("uurloon", $e_u_loon);
    $query->execute();
}

// UpdateEmployee

// printEmployeeWithCode
function getEmployeeWithCode($code):array
{
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
    $query = $db->prepare("SELECT * FROM employee where code = :code");
    $query->bindParam("code",$code);
    $query->execute();
    $employee = $query->fetchAll(PDO::FETCH_ASSOC);

    return  $employee;
}
// printEmployeeWithCode

//overzicht

function overzicht(){
    if (isset($_POST['submit'])){
        if (!empty($_POST['inputCode'])){
            $code = filter_input(INPUT_POST,'inputCode',FILTER_VALIDATE_INT);
            $employee = getEmployeeWithCode($code);
                foreach ($employee as $data){
                    echo $data['employee_first_name'];
            }
                if (empty($data['code'])){
                    echo "test";
                }
        }else{
            echo "Vul een code in!";
        }
    }
}

//overzicht