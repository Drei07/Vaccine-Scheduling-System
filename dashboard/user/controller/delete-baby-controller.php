<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}


    $babyId = $_GET["Id"];


    $pdoQuery = "UPDATE baby SET account_status = :account_status WHERE babyId=:babyId";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
    ":account_status"      => "disabled",
    ":babyId"                =>$babyId
    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Baby has succesfully removed";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header("Location: ../baby");


?>