<?php
	try {
		$pdoConnect = new PDO("mysql:host=localhost;dbname=vaccine_ms", "root", "");
		$pdoConnect->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

	}
	catch (PDOException $exc){
		echo $exc -> getMessage();
	}
    catch (PDOException $exc){
        echo $exc -> getMessage();
    exit();
    }
?>