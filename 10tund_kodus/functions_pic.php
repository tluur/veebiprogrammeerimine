<?php

	function addPicData($fileName, $altText, $privacy){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO vpphotos3 (userid, filename, alttext, privacy) VALUES (?, ?, ?, ?)");
		echo $conn->error;
		$stmt->bind_param("issi", $_SESSION["userID"], $fileName, $altText, $privacy);
		if($stmt->execute()){
			$notice = " Pildi andmed salvestati andmebaasi!";
		} else {
			$notice = " Pildi andmete salvestamine ebaönnestus tehnilistel põhjustel! " .$stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $notice;
	}
	
	function randomPicClass1(){	
		$notice_priva = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT filename FROM vpphotos3  WHERE privacy = '1'");
		echo $conn->error;
		$stmt->bind_result($filenameFromDb);
		$stmt->execute();
		$stmt->fetch();
		
			
		$stmt->close();
		$conn->close();
		return $notice_priva;
	}


function priva(){
	
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT filename FROM vpphotos3 WHERE privacy = '1'");
	echo $conn->error;
	$stmt->bind_result($filenameFromDb);
	$stmt->execute();
	while($stmt->fetch()){
		$notice .= "<p>" .$filenameFromDb .")</p> \n";
	}
	
	if(empty($notice)){
		$notice = "<p>Ptsitud sÃµnmieifpoi!</p> \n";
	}
		
	$stmt->close();
	$conn->close();
	return $notice;
}
	
