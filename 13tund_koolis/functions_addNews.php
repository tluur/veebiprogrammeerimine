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

function readNews(){
	
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT title, content, expire FROM news_database WHERE deleted IS NULL");
	echo $conn->error;
	$stmt->bind_result($titleFromDb, $contentFromDb, $expireFromDb);
	$stmt->execute();
	while($stmt->fetch()){
		$notice .= "<p><b><u> " .$titleFromDb ."</u></b>\n";
		$notice .= "<p> " .$contentFromDb ."\n";
		$notice .= "<p> " .$expireFromDb ."<hr>";
	}
	
	if(empty($notice)){
		$notice = "<p>Uudiseid ei ole!</p> \n";
	}
		
	$stmt->close();
	$conn->close();
	return $notice;
}
