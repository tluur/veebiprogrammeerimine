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
			//<img src="thumbs_kataloog/pilt" alt="" data-fn=faili nimi"> \n
			$picHTML .= '<img src="' .$GLOBALS["pic_upload_dir_thumb"] .$fileNameFromDb .'" alt="' .$altTextFromDb .'" data-fn="' .$fileNameFromDb .'">' ."\n";
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
	
	function readSelectedPicGallery($privacy){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT filename, alttext FROM vpphotos3 WHERE privacy<=? AND deleted IS NULL LIMIT ?,?");
		echo $conn->error;
		$stmt->bind_param("i", $privacy);
		$stmt->bind_result($fileNameFromDb, $altTextFromDb);
		$stmt->execute();
		$stmt->fetch();	
		$stmt->close();
		$conn->close();
		return $notice;
		}
		
	function readPicScores(){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT vpphotos3.id, vpusers3.firstname, vpusers3.lastname, vpphotos3.filename, vpphotos3.alttext, AVG(vpphotoratings.rating) as AvgValue FROM vpphotos3 JOIN vpusers3 ON vpphotos3.userid = vpusers3.id LEFT JOIN vpphotoratings ON vpphotoratings.photoid = vpphotos3.id WHERE vpphotos3.privacy <= ? AND deleted IS NULL GROUP BY vpphotos3.id DESC LIMIT ?, ?");
		echo $conn->error;
		$stmt->bind_param("i", $_SESSION["userID"]);
		$stmt->bind_result($PhotoIdFromDb, $UserFirstNameFromDb, $UserLastNameFromDb, $FileNameFromDb, $AltTxtFromDb, $AvgValueFromDb);
		$stmt->execute();
		while($stmt->fetch()){
			$notice .= "<p>" .$PhotoIdFromDb .$UserFirstNameFromDb .$UserLastNameFromDb .$FileNameFromDb .$AltTxtFromDb .$AvgValueFromDb .")</p> \n";			
		}		
		$stmt->close();
		$conn->close();
		return $notice;		
	}	
	
	function readAllPublicPicsPage_v2($privacy, $page, $limit){
		$picHTML = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT vpphotos3.id, vpusers3.firstname, vpusers3.lastname, vpphotos3.filename, vpphotos3.alttext, AVG(vpphotoratings.rating) as AvgValue FROM vpphotos3 JOIN vpusers3 ON vpphotos3.userid = vpusers3.id LEFT JOIN vpphotoratings ON vpphotoratings.photoid = vpphotos3.id WHERE vpphotos3.privacy <= ? AND deleted IS NULL GROUP BY vpphotos3.id DESC LIMIT ?, ?");
		echo $conn->error;
		$skip = ($page - 1) * $limit;
		$stmt->bind_param("iii", $privacy, $skip, $limit);
		$stmt->bind_result($PhotoIdFromDb, $UserFirstNameFromDb, $UserLastNameFromDb, $FileNameFromDb, $AltTxtFromDb, $AvgValueFromDb);
		$stmt->execute();
		while($stmt->fetch()){
			//<img src="thumbs_kataloog/pilt" alt=""> \n
			//<img src="thumbs_kataloog/pilt" alt="" data-fn="failinimi"> \n
			$picHTML .= '<div class="thumbGallery">' ."\n";
			$picHTML .= '<img class="thumbs" src="' .$GLOBALS["pic_upload_dir_thumb"] .$FileNameFromDb .'" alt="';
			if(empty($AltTextFromDb)){
				$picHTML .= "Pilt";
			} else {
				$picHTML .= $AltTextFromDb;
			}
			$picHTML .= '" data-fn="' .$FileNameFromDb .'"';
			$picHTML .= ' data-id="' .$PhotoIdFromDb .'"';
			$picHTML .= '>' ."\n";
			$picHTML .= "<p>" .$UserFirstNameFromDb ." " .$UserLastNameFromDb ."</p> \n";
			$picHTML .= '<p id="score' .$PhotoIdFromDb .'">';
			$picHTML .= "Hinne: " .round($AvgValueFromDb, 2);
			$picHTML .= "</div>";
		}
		if($picHTML == null){
			$picHTML = "<p> - !</p>";
		}
		$stmt->close();
		$conn->close();
		return $picHTML;
	}
	
		function readAllPics(){
		$picHTML = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT filename, alttext FROM vpphotos3 WHERE deleted IS NULL");
		echo $conn->error;
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


