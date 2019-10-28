<?php

    function change_passwd($password){
	$notice = "";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT password FROM vpusers3 WHERE userid = ?");
	echo $mysqli->error;
	$stmt->bind_param("i", $_SESSION["userID"]);
	$stmt->bind_result($passwordFromDb);
	if($stmt->execute()){
		//kui päring õnnestus
	  if($stmt->fetch()){
		//kasutaja on olemas
		if(password_verify($password, $passwordFromDb)){
		  //kui salasõna klapib
		  $stmt->close();
		  $stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM vpusers3 WHERE email=?");
		  echo $mysqli->error;
		  $stmt->bind_param("s", $email);
		  $stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb);
		  $stmt->execute();
		  $stmt->fetch();
		  $notice = "Sisse logis ".$firstnameFromDb ." " .$lastnameFromDb ."!";
		  //salvestame kasutaja nime sesiooni muutujatesse
		  
		  $_SESSION["userID"] = $idFromDb;
		  $_SESSION["userFirstname"] = $firstnameFromDb;
		  $_SESSION["userLastname"] = $lastnameFromDb;
		  		  
		  $stmt->close();
	      $mysqli->close();
		  
		  header("Location: home.php");
		  exit();
		} else {
		  $notice = "Vale salasõna!";
		}
	  } else {
		$notice = "Sellist kasutajat (" .$email .") ei leitud!"; 
	  }
	} else {
	  $notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
	}

	$stmt->close();
	$mysqli->close();
	return $notice;
	
	}