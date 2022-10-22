<?php 
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/admin-class.php';
require_once __DIR__. '/../../vendor/autoload.php';
include_once __DIR__.'/../../superadmin/controller/select-settings-coniguration-controller.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('../../');
}

$stmt = $admin_home->runQuery("SELECT * FROM admin WHERE userId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['adminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['btn-register'])){

    $appointment_id     = "APMTID-".(str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT));
    $baby_id            = trim($_POST['baby']);
    $health_center_id   = trim($_POST['health_center']);
    $services           = trim($_POST['services']);
    $description        = trim($_POST['description']);
    $start_datetime     = trim($_POST['start_datetime']);
    $end_datetime       = trim($_POST['end_datetime']);

    // SERVICES

    $pdoQuery = "SELECT * FROM services WHERE services_id = :services_id";
    $pdoResult3 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult3->execute(array(":services_id" => $services));
    $services_data = $pdoResult3->fetch(PDO::FETCH_ASSOC);

    $type_of_services = $services_data["services"];

    // BABY

    $pdoQuery = "SELECT * FROM baby WHERE babyid = :baby_id";
    $pdoResult2 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult2->execute(array(":baby_id" => $baby_id));
    $baby_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

    $baby_firstname  = $baby_data["first_name"];
    $baby_lastname   = $baby_data["last_name"];
    $parent_id       = $baby_data['parentId'];



        $pdoQuery = "INSERT INTO appointment_list (appointment_id,parent_id,baby_id,health_center_id,title,service_id,description,start_datetime,end_datetime) VALUES (:appointment_id,:parent_id,:baby_id,:health_center_id,:title,:service_id,:description,:start_datetime,:end_datetime)";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoResult->execute(
            array(
                
                ":appointment_id"   => $appointment_id,
                ":parent_id"        => $parent_id,
                ":baby_id"          => $baby_id,
                ":health_center_id" => $health_center_id,
                ":title"            => $type_of_services,
                ":service_id"       => $services,
                ":description"      => $description,
                ":start_datetime"   => $start_datetime,
                ":end_datetime"     => $end_datetime,
            )
        );

        $_SESSION['status_title'] = "Success!";
        $_SESSION['status'] = "Appointment has been added";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 40000;
        header('Location: ../appointment');

        if($pdoResult){




            // PARENT

            $pdoQuery = "SELECT * FROM user WHERE uniqueID = :uniqueID";
            $pdoResult1 = $pdoConnect->prepare($pdoQuery);
            $pdoExec = $pdoResult1->execute(array(":uniqueID" => $parent_id));
            $user_data = $pdoResult1->fetch(PDO::FETCH_ASSOC);

            $email      = $user_data["userEmail"];
            $firstname  = $user_data["userFirst_Name"];
            $lastname   = $user_data["userLast_Name"];


            // HEALTH CENTER

            $pdoQuery = "SELECT * FROM admin WHERE health_center_id = :health_center_id";
            $pdoResult3 = $pdoConnect->prepare($pdoQuery);
            $pdoExec = $pdoResult3->execute(array(":health_center_id" => $health_center_id));
            $health_center_data = $pdoResult3->fetch(PDO::FETCH_ASSOC);

            $health_center_name = $health_center_data["health_center_name"];

            // APPOINTMENT
            
            $pdoQuery = "SELECT * FROM appointment_list WHERE appointment_id = :appointment_id";
            $pdoResult4 = $pdoConnect->prepare($pdoQuery);
            $pdoExec = $pdoResult4->execute(array(":appointment_id" => $appointment_id));
            $appointment_data = $pdoResult4->fetch(PDO::FETCH_ASSOC);

            $Sdate = date("F d, Y h:i A",strtotime($appointment_data['start_datetime']));
            $Edate = date("F d, Y h:i A",strtotime($appointment_data['end_datetime']));


            
            // EMAIL

            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->SMTPDebug  = 0;                     
            $mail->SMTPAuth   = true;                  
            $mail->SMTPSecure = "tls";                 
            $mail->Host       = "smtp.gmail.com";      
            $mail->Port       = 587;             
            $mail->AddAddress($email);
            $mail->Username=$smtp_email;  
            $mail->Password=$smtp_password;            
            $mail->SetFrom($smtp_email, $system_name);
            $mail->Subject = "Infant Milestone Appointment Information";
            $content = 
            "<div class='mail' 
            style='
            background-color: white; 
            border-radius:10px; 
            text-align:center;
            border-style: solid;
            border-color:4px black;
            height:100%; 
            padding:1rem;'>

              <p style='
              color: #9053c7;
              font-weight:bold;
              font-size: 2rem;
              '>Infant Milestone
              </p>

              <p style='
              color:black;
              font-size: 1rem;
              font-weigth: 700px;
              '>$health_center_name
              </p>

              <p style='
              color:black;
              font-size: 1rem;
              '>Appointment Number:
              </p>

              <h1 style='
              color: black;
              font-size:2.5rem;
              '>$appointment_id
              </h1>

              <p style='
              color:black;
              font-size: .9rem;
              '>Hello Mr./Mrs. $firstname $lastname, your baby $baby_firstname $baby_lastname is scheduled at
              $Sdate to $Edate for $type_of_services.
              </p>
              
              <p style='
              color:red;
              font-size: 0.7rem;
              '>Note! This appointment number will be present at the $health_center_name on or before $Sdate to $Edate.
              </p>
              
              
            </div>";

            $mail->MsgHTML($content); 
            $mail->Send(); 
        }

}
else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../appointment');
}
?>