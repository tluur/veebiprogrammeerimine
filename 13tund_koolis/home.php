<?php
  require("../../../config_vp.php"); 
  require("functions_main.php");
  require("functions_user.php");
  $database = "if19_taavi_lu_1";
  
  //SESSIOON
  require("classes/Session.class.php");
  //sesioon, mis katkeb kui brauser suletakse ja on kätesaadav ainult meie domeenis meie lehelt
  SessionManager::sessionStart("vp", 0, "/~luurtaa", "greeny.cs.tlu.ee");
  
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
  
  //tegeleme küpsistega (cookies)
  //set cookie peab olema enne <html> elementi
  //nimi [väärtus, aegumine, path ehk kataloog, domeen (domain), secure ehk kas HTTPS], http only - kindlasti yle veebi]
  setcookie("vpname", $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"], time() + (86400 * 31), "/~luurtaa/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]),true);
  
  if(isset($_COOKIE["vpname"])){
	  echo "Kypsisest selgus nimi: " .$_COOKIE["vpname"];
  } else {
	  echo "Kypsist ei leitud!";
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
 <a href="AB_andmebaas.php">AB andmebaas</a> |
 <a href="picupload.php">Pildid Yles</a></p>
 <a href="publicgallery.php">Avalike piltide galerii</a> |
 <a href="picupload_front.php">Esikuva piltide galerii</a></p>
 <a href="delPicGallery.php">Kustuta pilte</a></p>
 <a href="addNews.php">Uudised</a></p>
 

 
 
<hr>

</body>
</html>















