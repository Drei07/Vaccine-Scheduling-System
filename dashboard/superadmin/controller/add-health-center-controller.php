<?php
require_once '../../admin/authentication/admin-class.php';

$reg_admin = new ADMIN();

if(isset($_POST['btn-register'])) {

    $health_center_id       = "HCID-".(str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT));
    $health_center_name     = trim($_POST['health_center_name']);
    $email                  = trim($_POST['Email']);

    // Picture
    $folder = "../../../src/img/" . basename($_FILES['health_center_image']['name']);
    $profile = $_FILES['health_center_image']['name'];

    // Generate Password
    $varchar = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shuffle = str_shuffle($varchar);
    $upass          = substr($shuffle,0,8);

    // Token Generator
    $tokencode      = md5(uniqid(rand()));

    $stmt = $reg_admin->runQuery("SELECT * FROM admin WHERE adminEmail=:email_id");
    $stmt->execute(array(":email_id"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Email Existed
    if($stmt->rowCount() > 0)
    {
      $_SESSION['status_title'] = "Oops!";
      $_SESSION['status'] = "Email already taken. Please try another one.";
      $_SESSION['status_code'] = "error";
      $_SESSION['status_timer'] = 100000;
    }
    else
    {
        if($reg_admin->register($health_center_id,$health_center_name,$email,$upass,$tokencode,$profile))
        {   
        $id = $reg_admin->lasdID();  
        $key = base64_encode($id);
        $id = $key;
        
        $message = "     
            Hello sir/maam $last_name,
            <br /><br />
            Welcome to San Vicente National High School Management System!
            <br /><br />
            Email:<br />$email
            Password:<br />$upass
            <br /><br />
            <a href='https://localhost/Vaccine-Scheduling-System/public/admin/verify?id=$id&code=$tokencode'>Click HERE to Verify your Account!</a>
            <br /><br />
            Thanks,";
            
        $subject = "Verify Email";
            
            $reg_admin->send_mail($email,$message,$subject,$smtp_email,$smtp_password,$system_name);
            $_SESSION['status_title'] = "Success!";
            $_SESSION['status'] = "Please check the Email to verify the account.";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_timer'] = 40000;
            header('Location: ../health-center');
            if (move_uploaded_file($_FILES['health_center_image']['tmp_name'], $folder)) {
                header('Location: ../health-center');
            }
        }
        else
        {

            $_SESSION['status_title'] = "Sorry !";
            $_SESSION['status'] = "Something went wrong, please try again!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_timer'] = 10000000;
            header('Location: ../health-center');

        }
    }
      

}

?>