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

  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  $notice = null;
  $myDescription = null;
  
  if(isset($_POST["submitProfile"])){
	$notice = storeUserProfile($_POST["description"], $_POST["bgcolor"], $_POST["txtcolor"]);
	if(!empty($_POST["description"])){
	  $myDescription = $_POST["description"];
}

	$_SESSION["bgColor"] = $_POST["bgcolor"];
	$_SESSION["txtColor"] = $_POST["txtcolor"];
  } else {
	$myProfileDesc = showMyDesc();
	if(!empty($myProfileDesc)){
	  $myDescription = $myProfileDesc;

    }

  }
  
  
require("header.php");

?>

<body>
<?php
	echo "<h1>" .$userName ." koolitöö leht</h1>"
	//echo "Kasutaja värvid on: " .$varvid 
	
	
?>
<p><b>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiselt võetavat sisu !</b></p>
<hr>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php echo $myDescription; ?></textarea><br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $_SESSION["bgColor"]; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $_SESSION["txtColor"]; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil">
	</form>

 <p><a href="?logout=1">Logi Välja</a> |
 <a href="userprofile.php">Kasutaja profiil</a></p>
 <a href="messages.php">Sõnumid</a> |
 <a href="changepass.php">Parooli vahetus</a></p>
 <a href="AB_andmebaas.php">AB andmebaas</a> |
 <a href="picupload.php">Pildid Yles</a></p>
 <a href="publicgallery.php">Avalike piltide galerii</a> |
 <a href="picupload_front.php">Esikuva piltide galerii</a></p> 
 <a href="home.php">Home</a></p> 


 
<hr>

</body>
</html>















