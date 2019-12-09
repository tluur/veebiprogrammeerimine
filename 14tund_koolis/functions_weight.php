<?php
function saveWeight($weight) {
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);	
	$stmt = $conn->prepare("INSERT INTO weight_database (userid, weight) VALUES(?,?)");
	echo $conn->error;
	$stmt->bind_param("ii", $_SESSION["userID"], $weight);
	if($stmt->execute()){
		$notice = "Kaal on salveststudf";
	} else {
		$notice = "Kaal ei ole salvestatud" .$stmt->error;
	}
		
	$stmt->close();
	$conn->close();
	return $notice;
}

function readWeight(){
	
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT weight,added,(SELECT AVG(weight) FROM weight_database) as weight2 FROM weight_database ORDER BY added ASC");
	echo $conn->error;
	$stmt->bind_result($weightFromDb, $addedFromDb, $weight2FromDb);
	$stmt->execute();
	while($stmt->fetch()){
		$notice .= "<p>".$weightFromDb ." kg. (Lisatud: " .$addedFromDb .")</p> \n";
		//$notice .= "<p>".ROUND($weight2FromDb, 2) ." kg.";
	
	}	
	if(empty($notice)){
		$notice = "<p>Ptsitud sõnmieifpoi!</p> \n";
	}
		
	$stmt->close();
	$conn->close();
	return $notice;
	
}

function readWeightAVG(){
	
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT AVG(weight) FROM weight_database as weight2");
	echo $conn->error;
	$stmt->bind_result($weight2FromDb);
	$stmt->execute();
	while($stmt->fetch()){
		
		$notice .= "<p>".ROUND($weight2FromDb, 2) ." kg.";
	
	}	
	if(empty($notice)){
		$notice = "<p>Ptsitud sõnmieifpoi!</p> \n";
	}
		
	$stmt->close();
	$conn->close();
	return $notice;
	
}

