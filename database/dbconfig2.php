<?php
	try {

		// localhost
		// $pdoConnect = new PDO("mysql:host=localhost;dbname=vaccine_ms", "root", "");

		// Live
		$pdoConnect = new PDO("mysql:host=localhost;dbname=u867039073_infant", "u867039073_infant", "Andreishania12");
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