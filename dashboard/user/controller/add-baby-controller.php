<?php
include_once __DIR__. '/../../../database/dbconfig2.php';
require_once '../authentication/user-class.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('');
}


if(isset($_POST['btn-register'])) {
    
    $parentID                       = trim($_POST['parentId']);
    $BabyID                         = "BBYID-".(str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT));
    $FName                          = trim($_POST['FName']);
    $MName                          = trim($_POST['MName']);
    $LName                          = trim($_POST['LName']);
    $Sex                            = trim($_POST['Sex']);
    $BirthDate                      = trim($_POST['BirthDate']);
    $Age                            = trim($_POST['Age']);
    $PBirth                         = trim($_POST['PBirth']);
    $name_hospital                  = trim($_POST['name_hospital']);
    $birth_weight                   = trim($_POST['birth_weight']);
    $birth_height                   = trim($_POST['birth_height']);
    $head_circumference             = trim($_POST['head_circumference']);
    $chest_circumference            = trim($_POST['chest_circumference']);
    $distinguishing_marks           = trim($_POST['distinguishing_marks']);
    $obstetrician                   = trim($_POST['obstetrician']);
    $Mother_FName                   = trim($_POST['Mother-FName']);
    $Mother_MName                   = trim($_POST['Mother-MName']);
    $Mother_LName                   = trim($_POST['Mother-LName']);
    $Mother_PNumber                 = trim($_POST['Mother-PNumber']);
    $Father_FName                   = trim($_POST['Father-FName']);
    $Father_MName                   = trim($_POST['Father-MName']);
    $Father_LName                   = trim($_POST['Father-LName']);
    $Father_PNumber                 = trim($_POST['Father-PNumber']);


    $folder = "../../../src/img/" . basename($_FILES['baby_image']['name']);
    $Picture = $_FILES['baby_image']['name'];


    $pdoQuery = "INSERT INTO baby 
        (
            parentId,
            babyId,
            first_name, 
            middle_name, 
            last_name, 
            sex, 
            birth_date, 
            age, 
            place_of_birth, 
            name_hospital, 
            birth_weight, 
            birth_height, 
            head_circumference, 
            chest_circumference, 
            distinguishing_marks, 
            obstetrician, 
            mother_first_name,
            mother_middle_name,
            mother_last_name,
            mother_phone_number,
            father_first_name,
            father_middle_name,
            father_last_name,
            father_phone_number,
            picture_of_baby 
        ) 
    VALUES 
    (
            :parentId,
            :babyId,
            :first_name, 
            :middle_name, 
            :last_name, 
            :sex, 
            :birth_date, 
            :age, 
            :place_of_birth, 
            :name_hospital, 
            :birth_weight, 
            :birth_height, 
            :head_circumference, 
            :chest_circumference, 
            :distinguishing_marks, 
            :obstetrician, 
            :mother_first_name,
            :mother_middle_name,
            :mother_last_name,
            :mother_phone_number,
            :father_first_name,
            :father_middle_name,
            :father_last_name,
            :father_phone_number,
            :picture_of_baby
        )";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute
    (
        array
        ( 
            ":parentId"                 =>$parentID,
            ":babyId"                   =>$BabyID,
            ":first_name"               =>$FName,
            ":middle_name"              =>$MName,
            ":last_name"                =>$LName,
            ":sex"                      =>$Sex,
            ":birth_date"               =>$BirthDate,
            ":age"                      =>$Age,
            ":place_of_birth"           =>$PBirth,
            ":name_hospital"             =>$name_hospital,
            ":birth_weight"              =>$birth_weight, 
            ":birth_height"              =>$birth_height,
            ":head_circumference"        =>$head_circumference,
            ":chest_circumference"       =>$chest_circumference,
            ":distinguishing_marks"      =>$distinguishing_marks,
            ":obstetrician"              =>$obstetrician,
            ":mother_first_name"        =>$Mother_FName,
            ":mother_middle_name"       =>$Mother_MName,
            ":mother_last_name"         =>$Mother_LName,
            ":mother_phone_number"      =>$Mother_PNumber,
            ":father_first_name"        =>$Father_FName,
            ":father_middle_name"       =>$Father_MName,
            ":father_last_name"         =>$Father_LName,
            ":father_phone_number"      =>$Father_PNumber,
            ":picture_of_baby"          =>$Picture
        )
      );

      $_SESSION['status_title'] = "Success!";
      $_SESSION['status'] = "Baby is now registered";
      $_SESSION['status_code'] = "success";
      $_SESSION['status_timer'] = 40000;
      header('Location: ../baby');

      if (move_uploaded_file($_FILES['baby_image']['tmp_name'], $folder)) {
        header('Location: ../baby');
    }
}

else
{
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "Something went wrong, please try again!";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header('Location: ../baby');

}

?>