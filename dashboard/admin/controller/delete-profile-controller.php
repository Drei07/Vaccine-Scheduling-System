<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/admin-class.php';



$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('');
}

    $profile                      = "profile.png";

    $pdoQuery = "UPDATE admin SET adminProfile=:profile WHERE userId =". $_GET['id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
    ":profile"                =>$profile,
    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Avatar successfully updated!";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header('Location: ../profile');
    $pdoConnect = null;


?>