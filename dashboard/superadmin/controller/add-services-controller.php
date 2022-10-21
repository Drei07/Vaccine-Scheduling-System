<?php 
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/superadmin-class.php';
require_once __DIR__. '/../../vendor/autoload.php';
include_once __DIR__.'/../../superadmin/controller/select-settings-coniguration-controller.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



$superadmin_home = new SUPERADMIN();

if(!$superadmin_home->is_logged_in())
{
 $superadmin_home->redirect('../../public/superadmin/signin');
}

$stmt = $superadmin_home->runQuery("SELECT * FROM superadmin WHERE superadminId=:uid");
$stmt->execute(array(":uid"=>$_SESSION['superadminSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['btn-register'])){

    $services         = trim($_POST['services']);
    $services_id      = "SRVCID-".(str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT));
    


        $pdoQuery = "INSERT INTO services (services_id, services) VALUES (:services_id, :services)";
        $pdoResult = $pdoConnect->prepare($pdoQuery);
        $pdoResult->execute(
            array(
                
                ":services"          => $services,
                ":services_id"       => $services_id,
            )
        );

        $_SESSION['status_title'] = "Success!";
        $_SESSION['status'] = "Services has been added";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_timer'] = 40000;
        header('Location: ../services');

}
else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../services');
}
?>