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
 $admin_home->redirect('');
}

$APMTID = $_GET["APMTID"];


    $pdoQuery = 'UPDATE appointment_list SET status = :status WHERE appointment_id =:appointment_id';
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
        ":status"   => "delete",
        ":appointment_id"   => $APMTID,

    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Appointment has been Deleted";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header("Location: ../appointment");


?>