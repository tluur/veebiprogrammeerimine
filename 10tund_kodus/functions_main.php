<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function latestPicture($privacy){

	$html = "<p>Pole pilti, mida n�idata!";

	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

	$stmt = $conn->prepare("SELECT filename, alttext FROM vpphotos3 WHERE id=(SELECT MAX(id) FROM vpphotos3 WHERE privacy=? AND deleted IS NULL)");

	echo $conn->error;

	$stmt->bind_param("i", $privacy);

	$stmt->bind_result($filenameFromDb, $altFromDb);

	$stmt->execute();

	if($stmt->fetch()){

		$html = '<img src="' .$GLOBALS["pic_upload_dir_w600"] .$filenameFromDb .'" alt="'.$altFromDb .'">';

	} else {

		$html = "<p>Kahjuks avalikke pilte pole!</p>";

	}



	$stmt->close();

	$conn->close();

	return $html;

}