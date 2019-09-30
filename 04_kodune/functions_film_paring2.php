<?php

		function sql2Paring($filmTitle, $filmYear, $filmDuration){
			$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
			$que1 = $_GET["filmYear"];
			$que = "SELECT pealkiri, kestus, aasta FROM film WHERE aasta > '.$que1'";
			$stmt = $conn->prepare($que);
			echo $conn->error;
			//s -string, i -integer, d -decimal
			$stmt->bind_param("i", $que1);
			$stmt->execute();
		
			$stmt->close();
			$conn->close();
	}
	
	
	
	function sqlParing(){
		//loeme andmebaasist
		//loome andmebaasi yhenduse (näiteks $conn)
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistame ette päringu
		$que1 = $_POST["filmYear"];
		$que = "SELECT pealkiri, kestus, aasta FROM film WHERE aasta > '.$que1'";
		$stmt = $conn->prepare($que);
		//seome saadava tulemuse muutujaga
		$stmt->bind_result($filmTitle, $filmDuration, $filmYear);
		
		//käivitame sql päringu
		$stmt->execute();
		$filmSqlParing = null;
		while($stmt->fetch()){
			if ($filmDuration > 60){
			$kestus = $filmDuration / 60;
			$jaak = $filmDuration%60;
			$kestus = ($filmDuration - $jaak) / 60;
		}
			$filmSqlParing .="<h3>" .$filmTitle ."</h3>";
			$filmSqlParing .="<p>Kestus: " .$kestus ." tund" ." " .$jaak ." minutit" .", Aastal: " .$filmYear .".</p>";
			//$filmifhoHTML .="<p>Tootmisaasta: " .$filmYear .".</p>";
			//echo $filmTitle; 
		}
				
		//sulgeme yhenduse
		$stmt->close();
		$conn->close();
		//väljastan väärtuse
		return $filmSqlParing;
	}
		

?>