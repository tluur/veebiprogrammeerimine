<?php


function readAll_AB(){
	
	$notice = null;
	
	
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT ISIK.Eesnimi, ISIK.Perekonnanimi, ISIK_FILMIS.Roll, FILM.Pealkiri, FILM.Sisukokkuv6te, AMET.Nimetus FROM ISIK JOIN ISIK_FILMIS ON ISIK.Isik_ID = 
	ISIK_FILMIS.ISIK_Isik_ID JOIN FILM ON ISIK_FILMIS.FILM_Film_ID = FILM.Film_ID JOIN AMET ON ISIK_FILMIS.AMET_Amet_ID = AMET.Amet_ID ORDER BY FILM.Pealkiri DESC");
	echo $conn->error;
	$stmt->bind_result($ISIK_EesnimiFromDb, $ISIK_PerekonnanimiFromDb, $ISIK_FILMI_RollFromDb, $FILM_PealkiriFromDb, $FILM_Sisukokkuv6teFromDb, $AMET_NimetusFromDb);
	$stmt->execute();
	while($stmt->fetch()){
		$notice .= "<p>\n Näitleja :" .$ISIK_EesnimiFromDb ."  " .$ISIK_PerekonnanimiFromDb ." <p> Isik filmis : " .$ISIK_FILMI_RollFromDb ." <p>\n Pealkiri : " .$FILM_PealkiriFromDb ."<p> \n Sisukokkuvõte : " .$FILM_Sisukokkuv6teFromDb ." \n <p> Roll : " . $AMET_NimetusFromDb ."<p>------------------";
	}
	
	if(empty($notice)){
		$notice = "<p>Ptsitud sõnmieifpoi!</p> \n";
	}
		
	$stmt->close();
	$conn->close();
	return $notice;
}

function saveFilmInfo_AB($filmTitle, $filmYear, $filmDuration, $filmIntro){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO FILM (Pealkiri, Aasta, Kestus, Sisukokkuv6te) VALUES(?,?,?,?)");
	echo $conn->error;
	//s -string, i -integer, d -decimal
	$stmt->bind_param("siis", $filmTitle, $filmYear, $filmDuration, $filmIntro);
	if($stmt->execute()){
	$notice = "Info on salveststudf";
	} else {
	$notice = "ei ole salvestatud" .$stmt->error;
	
		
	$stmt->close();
	$conn->close();
	return $notice;
			
	}
}

function saveFilmAmet($amet){
	$notice_roll = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO AMET (Nimetus) VALUES(?)");
	echo $conn->error;
	$stmt->bind_param("s", $amet);
		if($stmt->execute()){
	$notice_roll = "Info on salveststudf";
	} else {
	$notice_roll = "ei ole salvestatud" .$stmt->error;
	
		
	$stmt->close();
	$conn->close();
	return $notice_roll;	
	}
}

function saveFilmOsaleja($firstName, $surName, $birthDate){
	$notice_osaleja = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO ISIK (Eesnimi, Perekonnanimi, Synniaeg) VALUES(?,?,?)");
	echo $conn->error;
	$stmt->bind_param("sss", $firstName, $surName, $birthDate );
			if($stmt->execute()){
	$notice_osaleja = "Info on salveststudf";
	} else {
	$notice_osaleja = "ei ole salvestatud" .$stmt->error;
	
		
	$stmt->close();
	$conn->close();
	return $notice_osaleja;	
	}
	
	
	
	
}
	