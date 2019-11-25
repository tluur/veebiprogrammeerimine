
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

  

  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();

  }

  

  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];  

  $notice = null;  
	//piirid galerii lehele näidatava piltide arvu jaoks
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
	$publicThumbsHTML = readAllPublicPicsPage(2, $page, $limit);
	
  //$publicThumbsHTML = readAllPublicPics(2);
  require("header.php");
  
    if(isset($_POST["LoadGallery"])){
	  if(isset($_POST["privacy"]) and !empty($_POST["privacy"])){
		  $notice = readSelectedPicGallery (test_input($_POST["privacy"]));
	  }
	

  }
	$publicSelected = readSelectedPicGallery();

?>







<body>

  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>

  <h2>Avalike piltide galerii</h2>
  <p>
  
  <!--<a href="?page=1">Leht 1</a> | <a href="?page=2">Leht 2</a>-->
 <?php
	
	if($page > 1){
		echo '<a href="?page=' .($page - 1) .'">Eelmine leht</a> | ' ."\n";
	} else {
		echo "<span> Eelmine leht </span> | \n";
	}
	if($page * $limit < $totalPics) {
		echo '<a href="?page=' .($page + 1) .'">Järgmine leht</a>' ."\n";
	} else {
		echo "<span> Järgmine leht </span> | \n";
	}
 
 
 ?>
  
  
  </p>
  
  
  <?php
	echo $publicThumbsHTML;
	
	echo $publicSelected;

  ?>

  <hr>
    <label><h2>Vali mis liiki pilte vaatad!</h2></label>	
	<p>	
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	  <label><input type="radio" name="privacy" value="1">Avalikud pildid</label>&nbsp;	  

	  <label><input type="radio" name="privacy" value="3" checked>Isiklikud pildid</label>

      <br>

	  <input name="LoadGallery" type="submit" value="Lae galerii"><span><?php echo $notice; ?></span>

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
 <p>Tagasi <a href="home.php">avalehele</a></p>
  <hr>
</body>

</html>