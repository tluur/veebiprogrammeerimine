<?php

	function readAllFilms(){
		$kestus = "";
		$jaak = "";
		//loeme andmebaasist
		//loome andmebaasi yhenduse (n�iteks $conn)
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistame ette p�ringu
		$stmt = $conn->prepare("SELECT pealkiri, zanr, lavastaja, kestus, tootja, aasta FROM film");
		//seome saadava tulemuse muutujaga
		$stmt->bind_result($filmTitle, $filmGenre, $filmDirector, $filmDuration, $filmCompany, $filmYear);
		
		//k�ivitame sql p�ringu
		$stmt->execute();
		$filmifhoHTML = null;
		while($stmt->fetch()){
			if ($filmDuration > 60){
			//$kestus = $filmDuration / 60;
			$jaak = $filmDuration%60;
			$kestus = ($filmDuration - $jaak) / 60;
		}
			$filmifhoHTML .="<h3>" .$filmTitle ."</h3>";
			$filmifhoHTML .="<p>Zanr: " .$filmGenre .", Lavastaja: " .$filmDirector .", Kestus: " .$kestus ." tund" ." " .$jaak ." minutit" .", Tootnud: " .$filmCompany .", Aastal: " .$filmYear .".</p>";
			//$filmifhoHTML .="<p>Tootmisaasta: " .$filmYear .".</p>";
			//echo $filmTitle; 
		}
				
		//sulgeme yhenduse
		$stmt->close();
		$conn->close();
		//v�ljastan v��rtuse
		return $filmifhoHTML;
	}
	

		
	function saveFilmInfo($filmTitle, $filmYear, $filmDuration,
		$filmGenre, $filmCompany, $filmDirector){
			$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
			$stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
			echo $conn->error;
			//s -string, i -integer, d -decimal
			$stmt->bind_param("siisss", $filmTitle, $filmYear, $filmDuration,
			$filmGenre, $filmCompany, $filmDirector);
			$stmt->execute();
		
			$stmt->close();
			$conn->close();
	}
?>