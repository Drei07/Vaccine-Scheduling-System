<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/admin-class.php';
require_once __DIR__. '/../../vendor/autoload.php';
include_once __DIR__.'/../../superadmin/controller/select-settings-coniguration-controller.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$admin_home = new ADMIN();

if(!$admin_home->is_logged_in())
{
 $admin_home->redirect('');
}

$APMTID = $_GET["APMTID"];

if(isset($_POST['btn-update'])){

    $baby_id            = trim($_POST['baby']);
    $services           = trim($_POST['services']);
    $description        = trim($_POST['description']);
    $start_datetime     = trim($_POST['start_datetime']);
    $end_datetime       = trim($_POST['end_datetime']);

    // SERVICES

    $pdoQuery = "SELECT * FROM services WHERE services_id = :services_id";
    $pdoResult3 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult3->execute(array(":services_id" => $services));
    $services_data = $pdoResult3->fetch(PDO::FETCH_ASSOC);

    $type_of_services = $services_data["services"];

    $pdoQuery = 'UPDATE appointment_list SET baby_id=:baby_id, title=:title, service_id=:service_id,description=:description ,start_datetime=:start_datetime, end_datetime=:end_datetime WHERE appointment_id =:appointment_id';;
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 
        ":appointment_id"   => $APMTID,

        // DATA
        ":baby_id"          => $baby_id,
        ":title"            => $type_of_services,
        ":service_id"       => $services,
        ":description"      => $description,
        ":start_datetime"   => $start_datetime,
        ":end_datetime"     => $end_datetime,

    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Appointment has been updated";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header("Location: ../appointment_information?id=$APMTID");

}
else{

    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../appointment_information?id=$APMTID");
    
    
}

?>