<?php
include_once '../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}

$stmt = $user_home->runQuery("SELECT * FROM user WHERE userId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['btn-update-profile'])){

    $first_name     = trim($_POST['FName']);
    $middle_name    = trim($_POST['MName']);
    $last_name      = trim($_POST['LName']);
    $Sex            = trim($_POST['Sex']);
    $BirthDate      = trim($_POST['BirthDate']);
    $Age            = trim($_POST['Age']);
    $CStatus        = trim($_POST['CStatus']);
    $Religion       = trim($_POST['Religion']);
    $PNumber        = trim($_POST['PNumber']);

    $Province       = trim($_POST['Province']);
    $City           = trim($_POST['City']);
    $Barangay       = trim($_POST['Barangay']);
    $Street         = trim($_POST['Street']);
    

    $pdoQuery = "UPDATE user SET userFirst_Name=:userFirst_Name, userMiddle_Name=:userMiddle_Name, userLast_Name=:userLast_Name, userSex=:userSex, userBirthDate=:userBirthDate, userAge=:userAge, userCivilStatus=:userCivilStatus, userReligion=:userReligion, userProvince=:userProvince, userCity=:userCity, userBarangay=:userBarangay, userStreet=:userStreet, userPhone_Number=:userPhone_Number WHERE userId=". $_GET['id'];
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 

    ":userFirst_Name"              =>$first_name,
    ":userMiddle_Name"             =>$middle_name,
    ":userLast_Name"               =>$last_name,
    ":userSex"                     =>$Sex,
    ":userBirthDate"               =>$BirthDate,
    ":userAge"                     =>$Age,
    ":userCivilStatus"             =>$CStatus,
    ":userReligion"                =>$Religion,
    ":userProvince"                =>$Province,
    ":userCity"                    =>$City,
    ":userBarangay"                =>$Barangay,
    ":userStreet"                  =>$Street,
    ":userPhone_Number"            =>$PNumber,

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