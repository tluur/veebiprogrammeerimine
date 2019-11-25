<?php
  require("../../../config_vp.php"); 
  require("functions_main.php");
  require("functions_user.php");
  require("function_change_passw.php");
  $database = "if19_taavi_lu_1";
  $confirmpasswordError = null;
  $passwordError = "";
  $notice = null;
  
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

    	if(isset($_POST["submintNewPass"])){
		//salvestame kui vähemalt pealkiri on olemas
		if(!empty($_POST["password"])){
		$notice = change_passwd($_POST["password"], $_POST["password_n"], $_POST["password_n2"]);
		}
	}
  
   require("header.php");
	  
?>

<body>
<?php
  echo "<h1>" .$userName ." koolitöö leht</h1>"   
?>


<p><b>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiselt võetavat sisu !</b></p>

<hr>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Vana salasõna:</label><br>
	  <input name="password" type="password">&nbsp;<span><?php echo $passwordError; ?></span><br>
	  <label>Uus salasõna (min 8 tähemärki):</label><br>
	  <input name="password_n" type="password"><span><?php echo $passwordError; ?></span><br>
	  <label>Korrata salasõna:</label><br>
	  <input name="password_n2" type="password"><span><?php echo $confirmpasswordError; ?></span><br>
	  <input name="submintNewPass" type="submit" value="Vaheta parool"><span><?php echo $notice; ?></span>
	</form>
<hr>
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















