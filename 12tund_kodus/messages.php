<?php

require("../../../config_vp.php"); 
require("functions_main.php");
require("functions_user.php");
require("functions_message.php");
$database = "if19_taavi_lu_1";

  

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
  $messagesHTML = readMyMessages();



  

  if(isset($_POST["submitMessage"])){
	  if(isset($_POST["message"]) and !empty($_POST["message"])){
		  $notice = storeMessage (test_input($_POST["message"]));
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
	  <label>Minu sõnum</label><br>
	  <textarea rows="5" cols="50" name="message" placeholder="Lisa siia oma sõnum ..."></textarea>
	  <br>
	  <input name="submitMessage" type="submit" value="Salvesta sõnum"><span><?php echo $notice; ?></span>
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
 <?php
 echo $messagesHTML;
 ?>

</body>

</html>

