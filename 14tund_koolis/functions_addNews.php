<?php
function saveNews ($newsTitle, $newsEditor, $expireDate) {
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);	
	$stmt = $conn->prepare("INSERT INTO news_database (userid, title, content, expire) VALUES(?,?,?,?)");
	echo $conn->error;
	$stmt->bind_param("isss", $_SESSION["userID"], $newsTitle, $newsEditor, $expireDate);
	if($stmt->execute()){
		$notice = "Salvestatud";
	} else {
		$notice = "ei ole salvestatud" .$stmt->error;
	}
		
	$stmt->close();
	$conn->close();
	return $notice;
}

function readNews($limit){	
	$notice = null;
	$today = date("Y-m-d");
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT title, content FROM news_database WHERE expire >=? AND deleted IS NULL ORDER BY id DESC LIMIT ?");
	echo $conn->error;
	$stmt->bind_param("si", $today, $limit);
	$stmt->bind_result($titleFromDb, $contentFromDb);
	$stmt->execute();
	while($stmt->fetch()){
		$notice .= "<p><b><u> " .$titleFromDb ."</u></b>\n";
		$notice .= "<p> " .$contentFromDb ."\n";		
		
	}
	
	if(empty($notice)){
		$notice = "<p>Uudiseid ei ole!</p> \n";
	}
		
	$stmt->close();
	$conn->close();
	return $notice;
}
