<?php


function readAll_AB(){
	
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT ISIK.Eesnimi, ISIK.Perekonnanimi, ISIK_FILMIS.Roll, FILM.Pealkiri, AMET.Nimetus FROM ISIK JOIN ISIK_FILMIS ON ISIK.Isik_ID = 
	ISIK_FILMIS.ISIK_Isik_ID JOIN FILM ON ISIK_FILMIS.FILM_Film_ID = FILM.Film_ID JOIN AMET ON ISIK_FILMIS.AMET_Amet_ID = AMET.Amet_ID ORDER BY FILM.Pealkiri DESC");
	echo $conn->error;
	$stmt->bind_result($ISIK_EesnimiFromDb, $ISIK_PerekonnanimiFromDb, $ISIK_FILMI_RollFromDb, $FILM_PealkiriFromDb, $AMET_NimetusFromDb);
	$stmt->execute();
	while($stmt->fetch()){
		$notice .= "<p><h4>\n" .$ISIK_EesnimiFromDb ."  " .$ISIK_PerekonnanimiFromDb ." - " .$ISIK_FILMI_RollFromDb ." - " .$FILM_PealkiriFromDb ." - " .$AMET_NimetusFromDb ."</h2>";
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
	