<?php 
include_once '../database/dbconfig2.php';
if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $pdoConnect = null;
    exit;
}
extract($_POST);
$allday = isset($allday);

if(empty($id)){
    // $sql = "INSERT INTO `appointment_list` (`title`,`description`,`start_datetime`,`end_datetime`) VALUES ('$title','$description','$start_datetime','$end_datetime')";

    $pdoQuery = "INSERT INTO appointment_list (title, description,start_datetime,end_datetime) VALUES ($title,$description,$start_datetime,$end_datetime)";
    $pdoResult1 = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult1->execute();

}else{
    // $sql = "UPDATE `appointment_list` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";

    
    $pdoQuery = "UPDATE appointment_list SET title = $title, description = $description, start_datetime = $start_datetime, end_datetime = $end_datetime WHERE id = $id";;
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute();
}
$save = $conn->query($sql);
if($save){
    echo "<script> alert('Schedule Successfully Saved.'); location.replace('./') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$pdoConnect = null;
?>