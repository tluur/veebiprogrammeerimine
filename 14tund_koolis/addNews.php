<?php

require("../../../config_vp.php"); 
require("functions_main.php");
require("functions_user.php");
require("functions_addNews.php");
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
  //$messagesHTML = readMyMessages();
  $uudised = null;
  $uudised = readNews(5);
  
  
	$error = "";
	$newsTitle = "";
	$news = "";
	$expiredate = date("Y-m-d");
  

  if(isset($_POST["newsBtn"])){
	  if(isset($_POST["newsTitle"]) and !empty($_POST["newsTitle"])){
		  $notice = saveNews($_POST["newsTitle"], $_POST["newsEditor"], $_POST["expiredate"]);
	  }

  }
 
  require("header.php");

?>


<!-- Lisame tekstiredaktory TinyMCE -->

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>



<script>

tinymce.init({

		selector:'textarea#newsEditor',

		plugins: "link",

		menubar: 'edit',

});

</script>
<body>

  <?php

    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames

  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>


<h2>Lisa uudis</h2>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Uudise pealkiri:</label><br><input type="text" name="newsTitle" id="newsTitle" style="width: 100%;" value="<?php echo $newsTitle; ?>"><br>
		<label>Uudise sisu:</label><br>
		<textarea name="newsEditor" id="newsEditor"><?php echo $news; ?></textarea>
		<br>
		<label>Uudis nähtav kuni (kaasaarvatud)</label>
		<input type="date" name="expiredate" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php echo $expiredate; ?>">
		<input name="newsBtn" id="newsBtn" type="submit" value="Salvesta uudis!"
		<?php if ($notice == "Uudis salvestatud!"){echo "disabled";} ?>> <span>&nbsp;</span><span><?php echo $error; ?></span> 
	</form>

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
 


 <hr>
 <?php
 echo $uudised;
 ?>

</body>

</html>

