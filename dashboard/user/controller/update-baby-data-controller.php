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

if(isset($_POST['btn-update'])){

    $babyID = $_GET['Id'];

    $first_name     = trim($_POST['FName']);
    $middle_name    = trim($_POST['MName']);
    $last_name      = trim($_POST['LName']);
    $Sex            = trim($_POST['Sex']);
    $BirthDate      = trim($_POST['BirthDate']);
    $Age            = trim($_POST['Age']);
    $PBirth        = trim($_POST['PBirth']);
    $name_hospital       = trim($_POST['name_hospital']);
    $birth_weight        = trim($_POST['birth_weight']);

    $birth_height       = trim($_POST['birth_height']);
    $head_circumference           = trim($_POST['head_circumference']);
    $chest_circumference       = trim($_POST['chest_circumference']);
    $distinguishing_marks         = trim($_POST['distinguishing_marks']);
    $obstetrician         = trim($_POST['obstetrician']);

    $Mother_FName           = trim($_POST['Mother-FName']);
    $Mother_MName       = trim($_POST['Mother-MName']);
    $Mother_LName         = trim($_POST['Mother-LName']);
    $Mother_PNumber        = trim($_POST['Mother-PNumber']);

    $Father_FName           = trim($_POST['Father-FName']);
    $Father_MName       = trim($_POST['Father-MName']);
    $Father_LName         = trim($_POST['Father-LName']);
    $Father_PNumber         = trim($_POST['Father-PNumber']);

    

    $pdoQuery = "UPDATE baby SET first_name=:first_name,middle_name=:middle_name,last_name=:last_name, sex=:sex, birth_date=:birth_date, age=:age, place_of_birth=:place_of_birth, name_hospital=:name_hospital, birth_weight=:birth_weight, birth_height=:birth_height, head_circumference=:head_circumference, chest_circumference=:chest_circumference, distinguishing_marks=:distinguishing_marks ,obstetrician=:obstetrician,mother_first_name=:mother_first_name ,mother_middle_name=:mother_middle_name ,mother_last_name=:mother_last_name ,mother_phone_number=:mother_phone_number ,father_first_name=:father_first_name ,father_middle_name=:father_middle_name ,father_last_name=:father_last_name ,father_phone_number=:father_phone_number WHERE babyId=:babyId";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(
    array
    ( 

        ":babyId"              =>$_GET['Id'],

    ":first_name"              =>$first_name,
    ":middle_name"             =>$middle_name,
    ":last_name"               =>$last_name,
    ":sex"                     =>$Sex,
    ":birth_date"               =>$BirthDate,
    ":age"                     =>$Age,
    ":place_of_birth"             =>$PBirth,
    ":name_hospital"                =>$name_hospital,
    ":birth_weight"                =>$birth_weight,
    ":birth_height"                    =>$birth_height,
    ":head_circumference"                =>$head_circumference,
    ":chest_circumference"                  =>$chest_circumference,
    ":distinguishing_marks"            =>$distinguishing_marks,
    ":obstetrician"            =>$obstetrician,

     ":mother_first_name"            =>$Mother_FName,
     ":mother_middle_name"            =>$Mother_MName,
     ":mother_last_name"            =>$Mother_LName,
     ":mother_phone_number"            =>$Mother_PNumber,

     ":father_first_name"            =>$Father_FName,
     ":father_middle_name"            =>$Father_MName,
     ":father_last_name"            =>$Father_LName,
     ":father_phone_number"            =>$Father_PNumber


    )
    );

    $_SESSION['status_title'] = "Success!";
    $_SESSION['status'] = "Profile succesfully updated";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_timer'] = 40000;
    header("Location: ../baby-profile?Id=$babyID");

}
else{

    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../baby-profile?Id=$babyID");
    
    
}
