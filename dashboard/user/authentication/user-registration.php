<?php
require_once 'user-class.php';

//URL
$main_url = "https://infantmilestone.tech";

//LOCALHOST
// $main_url = "http://localhost/VACCINE-SCHEDULING-SYSTEM";

$reg_user = new USER();


if(isset($_POST['btn-register'])) {

    $FName                          = trim($_POST['FName']);
    $MName                          = trim($_POST['MName']);
    $LName                          = trim($_POST['LName']);
    $Sex                            = trim($_POST['Sex']);
    $BirthDate                      = trim($_POST['BirthDate']);
    $Age                            = trim($_POST['Age']);
    $CStatus                        = trim($_POST['CStatus']);
    $Religion                       = trim($_POST['Religion']);
    $PNumber                        = trim($_POST['PNumber']);
    $email                          = trim($_POST['Email']);
    $Province                       = trim($_POST['Province']);
    $City                           = trim($_POST['City']);
    $Barangay                       = trim($_POST['Barangay']);
    $Street                         = trim($_POST['Street']);


    // Generate Password
    $varchar         = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shuffle         = str_shuffle($varchar);
    $upass           = substr($shuffle,0,8);

    // Token Generator
    $tokencode      = md5(uniqid(rand()));

    //uniqueID
    $uniqueID            = "PRNTID-".(str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT));

    $stmt = $reg_user->runQuery("SELECT * FROM user WHERE userEmail=:email_id");
    $stmt->execute(array(":email_id"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Email Existed
    if($stmt->rowCount() > 0)
    {
      $_SESSION['status_title'] = "Oops!";
      $_SESSION['status'] = "Email already taken. Please try another one.";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 100000;
      header('Location: ../../../registration');
    }
    else
    {
        if($reg_user->register($FName,$MName,$LName,$Sex,$BirthDate,$Age,$CStatus,$Religion,$Province,$City,$Barangay,$Street,$PNumber,$email,$upass,$tokencode,$uniqueID))
        {   
        $id = $reg_user->lasdID();  
        $key = base64_encode($id);
        $id = $key;
        
        $message = "     
            Hello sir/maam $last_name,
            <br /><br />
            Welcome to Infant Milestone !
            <br /><br />
            Email:<br />$email
            Password:<br />$upass
            <br /><br />
            <a href='$main_url/public/user/verify?id=$id&code=$tokencode'>Click HERE to Verify your Account!</a>
            <br /><br />
            Thanks,";
            
        $subject = "Verify Email";
            
        $reg_user->send_mail($email,$message,$subject,$smtp_email,$smtp_password,$system_name);
        $_SESSION['status_title'] = "Success!";
        $_SESSION['status'] = "Please check the Email to verify the account.";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 40000;
        header('Location: ../../../');
        }
        else
        {

            $_SESSION['status_title'] = "Sorry !";
            $_SESSION['status'] = "Something went wrong, please try again!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 10000000;
            header('Location: ../../../registration');

        }
    }
      

}

?>