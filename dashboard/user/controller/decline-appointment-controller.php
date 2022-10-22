<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}


$APMTID = $_GET["APMTID"];


    $pdoQuery = 'UPDATE appointment_list SET status = :status WHERE appointment_id =:appointment_id';
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
        ":status"   => "decline",
        ":appointment_id"   => $APMTID,

    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Appointment has been Accepted";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header("Location: ../appointment");


?>