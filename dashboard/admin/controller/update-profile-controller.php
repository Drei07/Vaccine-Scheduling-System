<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/admin-class.php';



$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('');
}

if(isset($_POST['btn-update-profile'])){

    $name     = trim($_POST['Name']);

    $pdoQuery = "UPDATE admin SET health_center_name=:health_center_name WHERE userId=". $_GET['id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 

    ":health_center_name"              =>$name,

    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Profile succesfully updated";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header('Location: ../profile');

}
else{

    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../profile');
    
    
}

?>