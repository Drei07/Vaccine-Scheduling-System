<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}

if(isset($_POST['btn-update'])){

    $babyId = $_GET["Id"];

    $folder = "../../../src/img/" . basename($_FILES['baby_picture']['name']);
    $Picture = $_FILES['baby_picture']['name'];

    $pdoQuery = 'UPDATE baby SET picture_of_baby = :picture_of_baby WHERE babyId=:babyId';
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
    ":picture_of_baby"       =>$Picture,
    ":babyId"                =>$babyId
    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = " Baby profile succesfully updated";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header("Location: ../baby-profile?Id=$babyId");

    if (move_uploaded_file($_FILES['baby_picture']['tmp_name'], $folder)) {
        header("Location: ../baby-profile?Id=$babyId");
    }
}
else{

    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../baby-profile?Id=$babyId");
    
    
}


?>