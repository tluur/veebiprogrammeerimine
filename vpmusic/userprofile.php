<?php
require("../../../config_vp.php"); 
require("functions_main.php");
require("functions_user.php");
$database = "if19_taavi_lu_1";
$userName = $_SESSION["userFirstname"] ." ".$_SESSION["userLastname"];
$mydescription = "";
$mybgcolor = null;
$mytxtcolor = null;
	
	
function userProIn($userID, $mydescription, $mybgcolor, $mytxtcolor){
	
	$notice = null;
	$_SESSION["description"] = $mydescription;
    $_SESSION["bgcolor"] = $mybgcolor;
    $_SESSION["txtcolor"] = $mytxtcolor;
	
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpuserprofiles (userid, description, bgcolor, txtcolor) VALUES(?,?,?,?)");
	echo $conn->error;
	$stmt->bind_param("isss", $userID, $mydescription, $mybgcolor, $mytxtcolor);
	
	if ($stmt->execute()){
		$notice = "Salvestamine õnnestus";
		$_SESSION["description"] = $mydescription;
        $_SESSION["bgcolor"] = $mybgcolor;
        $_SESSION["txtcolor"] = $mytxtcolor;
	
	} else {
		$notice = "Salvestamine ebaõnnestus" . $stmt->error;
	}

	return $notice;
	$stmt->close();
	$conn->close();
}
	
	
	//var_dump($_POST);
if(isset($_POST["submitProfile"])){
	$mydescription = $_POST["description"];
	$mybgcolor = $_POST["bgcolor"];
	$mytxtcolor = $_POST["txtcolor"];
	$notice = userProIn($_SESSION["userID"], $mydescription, $mybgcolor, $mytxtcolor);		
}
	
	
 
  
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
  
  
  
require("header.php");
	  
?>

<body background="bg.gif">
<?php
	echo "<h1>" .$userName ." koolitöö leht</h1>"
  
?>
<p><b>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiselt võetavat sisu !</b></p>
<hr>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea><br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil">
	</form>

 <p><a href="?logout=1">Logi Välja</a> |
 <a href="userprofile.php">Kasutaja profiil</a></p>
 
<hr>

</body>
</html>















