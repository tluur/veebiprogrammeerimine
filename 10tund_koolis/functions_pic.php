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


	function readAllPublicPics($privacy){

		$picHTML = null;

		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

		$stmt = $conn->prepare("SELECT filename, alttext FROM vpphotos3 WHERE privacy<=? AND deleted IS NULL");

		echo $conn->error;

		$stmt->bind_param("i", $privacy);

		$stmt->bind_result($fileNameFromDb, $altTextFromDb);

		$stmt->execute();

		while($stmt->fetch()){

			//<img src="thumbs_kataloog/pilt" alt=""> \n

			$picHTML .= '<img src="' .$GLOBALS["pic_upload_dir_thumb"] .$fileNameFromDb .'" alt="' .$altTextFromDb .'">' ."\n";

		}

		if($picHTML == null){

			$picHTML = "<p>Kahjuks avalikke pilte pole!</p>";

		}

		$stmt->close();

		$conn->close();

		return $picHTML;

	}
	
	function readAllPublicPicsPage($privacy, $page, $limit){
		$picHTML = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT filename, alttext FROM vpphotos3 WHERE privacy<=? AND deleted IS NULL LIMIT ?,?");
		echo $conn->error;
		$skip = ($page - 1) * $limit;
		$stmt->bind_param("iii", $privacy, $skip, $limit);
		$stmt->bind_result($fileNameFromDb, $altTextFromDb);
		$stmt->execute();
		while($stmt->fetch()){
			//<img src="thumbs_kataloog/pilt" alt=""> \n
			$picHTML .= '<img src="' .$GLOBALS["pic_upload_dir_thumb"] .$fileNameFromDb .'" alt="' .$altTextFromDb .'">' ."\n";
		}

		if($picHTML == null){

			$picHTML = "<p>Kahjuks avalikke pilte pole!</p>";

		}

		$stmt->close();

		$conn->close();

		return $picHTML;

	}
	
	function countPublicImages($privacy){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT COUNT(*) FROM vpphotos3 WHERE privacy<=? AND deleted IS NULL");
		echo $conn->error;
		$stmt->bind_param("i", $privacy);
		$stmt->bind_result($imageCountFromDb);
		$stmt->execute();
		if($stmt->fetch()){
			$notice = $imageCountFromDb;
	} else{
		$notice = 0;
	}
		$stmt->close();
		$conn->close();
		return $notice;
	}
