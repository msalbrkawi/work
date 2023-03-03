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
function getEmployeeWithCode($code)
{
    global $employee;
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
    $query = $db->prepare("SELECT * FROM employee where code = :code");
    $query->bindParam("code",$code);
    $query->execute();
    $employee = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['uurloon'] = $employee['uurloon'];
    if (!$employee){
        return false;
    }else{
        return $employee;
    }

}
// printEmployeeWithCode

//overzicht

function overzicht(){
    if (isset($_POST['submit'])){
        if (!empty($_POST['inputCode'])){
            global $employee, $script, $salary;
            getEmployeeWithCode($_POST['inputCode']);
            if (!$employee){
                echo "try again!";
            }elseif ($employee['code'] == $_POST['inputCode']){
                $_SESSION['$employee_id'] = $employee['employee_id'];
                $_SESSION['$employee_code'] = $employee['code'];
                $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
                $query = $db->prepare("
SELECT * 
FROM salary
where day_date = :toDayDate and code = :code
");
                $toDayDate = date('o-m-d');
                $query->bindParam("toDayDate", $toDayDate);
                $query->bindParam("code", $employee['code']);
                $query->execute();
                $salarys = $query->fetchAll(PDO::FETCH_ASSOC);
                $script = " startDia.showModal(); ";
                employeeStart();
                foreach ($salarys as $salary){
                        if($salary['status'] == "Active"){
                        $_SESSION['salary_id'] = $salary['salary_id'];
                        getSalaryWithCode($_SESSION['$employee_code']);
                        $script = " endDia.showModal(); ";
                    }else{
                        $script = " startDia.showModal(); ";
                        employeeStart();
                    }
                }
            }
        }else{
            echo "Vul een code in!";
        }
    }
}

function employeeStart(){
    if (isset($_POST['start'])){
        global $startTime, $status, $toDayDate;
        $toDayDate = date('o-m-d');
        $startTime = $_POST['startTime'];
        $status = "Active";
        $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
        $query = $db->prepare("INSERT INTO salary (day_date, start_date, status, code, employee_id, manger_id) VALUES (:day_date, :start_date, :status, :code, :employee_id, :manger_id)");
        $query->bindParam("day_date",$toDayDate);
        $query->bindParam("start_date",$startTime);
        $query->bindParam("status",$status);
        $query->bindParam("code",$_SESSION['$employee_code']);
        $query->bindParam("employee_id",$_SESSION['$employee_id']);
        $query->bindParam("manger_id",$_SESSION['AId']);
        $query->execute();
        header("location: http://kloksysteem.localhost/admin/overzicht");
    }
}

function employeeStop($id){
if (isset($_POST['end'])){
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
    $query = $db->prepare("update salary set start_date = :start_date, end_date = :end_date, total_hours = :total_hours, status = :status, salary = :salary where salary_id = :salary_id");
    $status = "Not Active";
    $start_time = $_POST['startTime'];
    $end_time = $_POST['endTime'];
    $str = str_replace(":", ".", $start_time);
    $str2 =  str_replace(":", ".", $end_time);
    $float_value = floatval($str);
    $float_value2 = floatval($str2);
    $total = $float_value2 - $float_value;
    $salary =round( $total * floatval( $_SESSION['uurloon']),2);
    $query->bindParam("salary",$salary);
    $query->bindParam("total_hours",$total);
    $query->bindParam("start_date",$start_time);
    $query->bindParam("end_date",$end_time);
    $query->bindParam("salary_id",$id);
    $query->bindParam("status",$status);
    $query->execute();
    header("location: http://kloksysteem.localhost/admin/overzicht");
}
}

function getSalary():array
{
    $toDayDate = date('o-m-d');
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
    $query = $db->prepare("
SELECT * 
FROM salary
INNER JOIN employee
ON employee.employee_id = salary.employee_id
where day_date = :toDayDate and status = :status and salary.manger_id = :manger_id
order by salary.start_date

");
    $status = "Active";
    $manger_id = $_SESSION['AId'];
    $query->bindParam("manger_id", $manger_id );
    $query->bindParam("toDayDate", $toDayDate);
    $query->bindParam("status", $status);
    $query->execute();
    $salary = $query->fetchAll(PDO::FETCH_ASSOC);

    return  $salary;
}

function getSalaryWithCode($code)
{
    $toDayDate = date('o-m-d');
    $db = new PDO("mysql:host=localhost;dbname=kloksysteem","root","");
    $query = $db->prepare("
SELECT * 
FROM salary
where day_date = :toDayDate and code = :code and salary_id = :salary_id

");
    $salary_id = $_SESSION['salary_id'];
    $query->bindParam("salary_id", $salary_id);
    $query->bindParam("toDayDate", $toDayDate);
    $query->bindParam("code", $code);
    $query->execute();
    $salaryWithCode = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['salaryWithCode'] = $salaryWithCode;
    return  $salaryWithCode;
}
//overzicht