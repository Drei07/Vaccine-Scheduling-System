<?php 
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';
require_once __DIR__. '/../../vendor/autoload.php';
include_once __DIR__.'/../../superadmin/controller/select-settings-coniguration-controller.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}

if (isset($_POST['btn-register'])){

    $userid             = trim($_POST['userid']);
    $appointment_id     = "APMTID-".(str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT));
    $baby_id            = trim($_POST['baby']);
    $health_center_id   = trim($_POST['health_center']);
    $title              = trim($_POST['title']);
    $description        = trim($_POST['description']);
    $start_datetime     = trim($_POST['start_datetime']);
    $end_datetime       = trim($_POST['end_datetime']);
    


        $pdoQuery = "INSERT INTO appointment_list (user_id,appointment_id,baby_id,health_center_id,title,description,start_datetime,end_datetime) VALUES (:user_id,:appointment_id,:baby_id,:health_center_id,:title,:description,:start_datetime,:end_datetime)";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoResult->execute(
            array(
                
                ":user_id"          => $userid,
                ":appointment_id"   => $appointment_id,
                ":baby_id"          => $baby_id,
                ":health_center_id" => $health_center_id,
                ":title"            => $title,
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
            $pdoExec = $pdoResult1->execute(array(":uniqueID" => $userid));
            $user_data = $pdoResult1->fetch(PDO::FETCH_ASSOC);

            $email      = $user_data["userEmail"];
            $firstname  = $user_data["userFirst_Name"];
            $lastname   = $user_data["userLast_Name"];

            // BABY

            $pdoQuery = "SELECT * FROM baby WHERE babyid = :baby_id";
            $pdoResult2 = $pdoConnect->prepare($pdoQuery);
            $pdoExec = $pdoResult2->execute(array(":baby_id" => $baby_id));
            $baby_data = $pdoResult2->fetch(PDO::FETCH_ASSOC);

            $baby_firstname  = $baby_data["first_name"];
            $baby_lastname   = $baby_data["last_name"];

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
            $title = $appointment_data["title"];

            
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
              '>Thank your for using our system Mr./Mrs. $firstname $lastname, your baby $baby_firstname $baby_lastname is scheduled at
              $Sdate to $Edate for $title.
              </p>
              
              <p style='
              color:red;
              font-size: 0.7rem;
              '>Note! This appointment number will be present at the $health_center_name at your choosen date.
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