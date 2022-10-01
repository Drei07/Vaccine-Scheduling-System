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

$APMTID = $_GET["APMTID"];

if(isset($_POST['btn-update'])){

    $health_center_id   = trim($_POST['health_center']);
    $baby_id            = trim($_POST['baby']);
    $title              = trim($_POST['title']);
    $description        = trim($_POST['description']);
    $start_datetime     = trim($_POST['start_datetime']);
    $end_datetime       = trim($_POST['end_datetime']);

    $pdoQuery = 'UPDATE appointment_list SET baby_id=:baby_id, health_center_id=:health_center_id, title=:title, description=:description ,start_datetime=:start_datetime, end_datetime=:end_datetime WHERE appointment_id =:appointment_id';;
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
        ":appointment_id"   => $APMTID,
        ":baby_id"          => $baby_id,
        ":health_center_id" => $health_center_id,
        ":title"            => $title,
        ":description"      => $description,
        ":start_datetime"   => $start_datetime,
        ":end_datetime"     => $end_datetime,

    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Appointment has been updated";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header("Location: ../appointment_information?id=$APMTID");

}
else{

    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../appointment_information?id=$APMTID");
    
    
}

?>