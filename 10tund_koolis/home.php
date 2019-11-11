<?php
  require("../../../config_vp.php"); 
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_taavi_lu_1";
  

  
  //kui pole sisse logitud
  if(!isset($_SESSION["userID"])){
	  //siis jõuga sisselogimise lehele
	  header("Location: page.php");
	  exit();
	    
  }
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
	  
	  
  }
  $userName = $_SESSION["userFirstname"] ." ".$_SESSION["userLastname"];

  
  
   require("header.php");
	  
?>
<!DOCTYPE html>
<html lang="et">
  <head>
    <meta charset="utf-8">
	<title>T koolitöö leht</title>
	
  </head>

<body>
<?php
  echo "<h1>" .$userName ." koolitöö leht</h1>"
 
  
?>
<p><b>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiselt võetavat sisu !</b></p>
<hr>
 <p><a href="?logout=1">Logi Välja</a> |
 <a href="userprofile.php">Kasutaja profiil</a></p>
 <a href="messages.php">Sõnumid</a> |
 <a href="changepass.php">Parooli vahetus</a></p>
 <a href="AB_andmebaas.php">AB andmebaas</a></p>
 <a href="picupload.php">Pildid üles</a></p>
 <a href="publicgallery.php">Avalike piltide galerii</a></p>
  
 
<hr>

</body>
</html>















