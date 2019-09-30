<?php

	function readAllFilms(){
		//loeme andmebaasist
		//loome andmebaasi yhenduse (n�iteks $conn)
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistame ette p�ringu
		$stmt = $conn->prepare("SELECT pealkiri, aasta FROM film");
		//seome saadava tulemuse muutujaga
		$stmt->bind_result($filmTitle, $filmYear);	
		//k�ivitame sql p�ringu
		$stmt->execute();
		$filmifhoHTML = null;
		while($stmt->fetch()){
			$filmifhoHTML .="<h3>" .$filmTitle ."</h3>";
			$filmifhoHTML .="<p>Tootmisaasta: " .$filmYear .".</p>";
			
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