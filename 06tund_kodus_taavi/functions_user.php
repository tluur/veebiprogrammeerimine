<?php

	function signUp($name, $surname, $email, $gender, $birthDate, $password){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpusers3 (firstname, lastname, birthdate, gender, email, password) VALUES (?,?,?,?,?,?)");
	echo $conn->error;
	
	
	//valmistame parooli salvestamiseks ette
	$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	
	$stmt->bind_param("sssiss",$name, $surname, $birthDate, $gender, $email, $pwdhash);
	
	if ($stmt->execute()){
		$notice = "Salvestamine õnnestus !";
	}else {
		$notice = "Kasutaja salvestamisel tekkis tehniline viga !" .$stmt->error;
	}
	
	
	$stmt->close();
	$conn->close();
	
	return $notice;
	}
	
	function signIn(){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$uemail = $_POST['email'];
		$stmt = $conn->prepare("SELECT email, password FROM vpusers3 WHERE email = '$uemail'");
		$stmt->bind_result($name, $surname, $birthDate, $gender, $email);
		$stmt->execute();
		$paringTulem = null;
		while($stmt->fetch()){
			$paringTulem .="<p>Nimi: " .$name ."Perenimi :" .$surname ."Sünniaeg :" .$birthDate ."Sugu :" .$gender ."email :" .$email.".</p>";
			
		}
		$stmt->close();
		$conn->close();
		
		return $paringTulem;
		
		//parroli õigsuse kontroll
		//if(password_verify($password, $passwordFromDB))
	}
