<?php

require("../../../config_vp.php"); 
require("functions_main.php");
require("functions_user.php");
require("functions_weight.php");
$database = "if19_taavi_lu_1";
  //SESSIOON
  require("classes/Session.class.php");
  //sesioon, mis katkeb kui brauser suletakse ja on kätesaadav ainult meie domeenis meie lehelt
  SessionManager::sessionStart("vp", 0, "/~luurtaa", "greeny.cs.tlu.ee");
  

  //kui pole sisseloginud

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
  $messagesHTML = null;
  //$messagesHTML = readAllMessages();
  $readW = readWeight();
  $readWAgv = readWeightAVG();

   

  if(isset($_POST["submitWeight"])){
	  if(isset($_POST["weight"]) and !empty($_POST["weight"])){
		  $notice = saveWeight($_POST["weight"]);
	  }

  }

  

  require("header.php");

?>


<body>

  <?php

    echo "<h1>" .$userName ." koolitöö leht</h1>";

  ?>

  <p>See leht on loodud koolis õppetöö raames

  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>


  

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Sisesta kaal:</label>
	  <input type="number" name="weight" value="75" min="2" step=".5" > kg
	  <br>
	  <input name="submitWeight" type="submit" value="Salvesta"><span><?php echo $notice; ?></span>
	</form>
 <hr>
 <?php
 echo $readW;
 echo "Keskmine kaal : ".$readWAgv;
 ?>
 <hr>
 <p>
<li><a href="home.php">Home</a></li>
 <li><a href="?logout=1">Logi Välja</a></li>
 <li><a href="userprofile.php">Kasutaja profiil</a></li>
 <li><a href="messages.php">Sõnumid</a></li>
 <li><a href="changepass.php">Parooli vahetus</a></li>
 <li><a href="AB_andmebaas.php">AB andmebaas</a></li>
 <li><a href="picupload.php">Pildid Yles</a></li>
 <li><a href="publicgallery.php">Avalike piltide galerii</a></li>
 <li><a href="picupload_front.php">Esikuva piltide galerii</a></li>
 <li><a href="delPicGallery.php">Kustuta pilte</a></li>
 <li><a href="addNews.php">Uudised</a></li> 




</body>

</html>

