
<?php

  require("../../../config_vp.php"); 
  require("functions_main.php");
  require("functions_user.php");
  require("functions_pic.php");
  $database = "if19_taavi_lu_1";

  //kui pole sisseloginud
  if(!isset($_SESSION["userID"])){
	  header("Location: page.php");
	  exit();
  }

  //v�ljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();

  }

  

  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];  

  $notice = null;  
	//piirid galerii lehele n�idatava piltide arvu jaoks
	$page = 1;
	$limit = 5;
	$totalPics = countPublicImages(2);
	if(!isset($_GET["page"]) or $_GET["page"] < 1){
	$page = 1;
	} elseif (round($_GET["page"] - 1) * $limit > $totalPics){
		$page = round($totalPics / $limit) -1;
	} else {
		$page = $_GET["page"];
	}
	$publicThumbsHTML = readAllPics($page, $limit); 

  //$publicThumbsHTML = readAllPublicPics(2);
  $toScript = "\t" .'<link rel="stylesheet" type="text/css" href="style/modal.css">' ."\n";
  $toScript .= "\t" .'<script type="text/javascript" src="javascript/modal.js" defer></script>' .
  require("header.php");

?>







<body>

  <?php
    echo "<h1>" .$userName ." koolit�� leht</h1>";
  ?>
  <p>See leht on loodud koolis </p>
  <hr>
  <p><a href="?logout=1">Logi v�lja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  <hr>
  <h2>Kustuta pildid galerii</h2>
    <div id="myModalDel" class="modal">
	<!--Sulgemisnupp-->
	<span id="close" class="close">&times;</span>
	<!--pildikoht-->
	<img id="modalImg" class="modal-content">
	<div id="caption"></div>
	<center>>
	<div id="delatePic" class="modalcaption">
		<input name="deletePic" type="submit" value="Kustuta pilt" id="delete">
	</div>
	</center>
		
  </div>
  
  <!--<a href="?page=1">Leht 1</a> | <a href="?page=2">Leht 2</a>-->
 <?php
	
	if($page > 1){
		echo '<a href="?page=' .($page - 1) .'">Eelmine leht</a> | ' ."\n";
	} else {
		echo "<span> Eelmine leht </span> | \n";
	}
	if($page * $limit < $totalPics) {
		echo '<a href="?page=' .($page + 1) .'">J�rgmine leht</a>' ."\n";
	} else {
		echo "<span> J�rgmine leht </span> | \n";
	}
 
 
 ?>
  
  
  </p>
  
  
  <?php
	//echo $publicThumbsHTML;

  ?>
  <div id="gallery">
	  <?php
		echo $publicThumbsHTML;
		//echo $readScores;
	  ?>
  </div>
  <hr>
 <a href="?logout=1">Logi Välja</a> |
 <a href="userprofile.php">Kasutaja profiil</a></p>
 <a href="messages.php">Sõnumid</a> |
 <a href="changepass.php">Parooli vahetus</a></p>
 <a href="AB_andmebaas.php">AB andmebaas</a> |
 <a href="picupload.php">Pildid Yles</a></p>
 <a href="publicgallery.php">Avalike piltide galerii</a> |
 <a href="picupload_front.php">Esikuva piltide galerii</a></p>

 <a href="home.php">Home</a></p> 

</body>

</html>