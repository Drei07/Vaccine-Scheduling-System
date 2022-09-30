<?php 
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $id                 = trim($_POST['id']);
    $appointment_id     = "APMTID-".(str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT));
    $baby_id             = trim($_POST['baby']);
    $title              = trim($_POST['title']);
    $description        = trim($_POST['description']);
    $start_datetime     = trim($_POST['start_datetime']);
    $end_datetime       = trim($_POST['end_datetime']);
    

    if(empty($id)){

        $pdoQuery = "INSERT INTO appointment_list (appointment_id,baby_id,title,description,start_datetime,end_datetime) VALUES (:appointment_id,:baby_id,:title,:description,:start_datetime,:end_datetime)";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoResult->execute(
            array(
                
                ":appointment_id"   => $appointment_id,
                ":baby_id"          => $baby_id,
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

    }
    else{
        
        $pdoQuery = "UPDATE appointment_list SET title = :title, description = :description, start_datetime = :start_datetime, end_datetime = :end_datetime WHERE id = :id";;
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoResult->execute(
            array(
                ":id"               => $id,
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
        header('Location: ../appointment');
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