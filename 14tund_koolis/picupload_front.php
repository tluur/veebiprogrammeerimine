
<?php

  require("../../../config_vp.php"); 
  require("functions_main.php");
  require("functions_user.php");
  require("functions_pic_front.php");
  //v�tan kasutusele oma klassi
  //require("classes/Test.class.php");
  require("classes/Picupload.class.php");
  $database = "if19_taavi_lu_1";
  //SESSIOON
  require("classes/Session.class.php");
  //sesioon, mis katkeb kui brauser suletakse ja on k�tesaadav ainult meie domeenis meie lehelt
  SessionManager::sessionStart("vp", 0, "/~luurtaa", "greeny.cs.tlu.ee");
  

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

  

  //kasutan oma testklassi

  //$myTest = new Test(1337);

  //echo "Salajane: " .$myTest->secretNumber;

  //echo "Avalik : " .$myTest->publicNumber;

  //$myTest->showValues();

  //$myTest->tellSecret();

  //unset($myTest);

  //$myTest->showValues();

  

  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];

  

  $notice = null;
  $fileSizeLimit = 2500000;
  $maxPicW = 600;
  $maxPicH = 400;
  $fileNamePrefix = "vp_";
  $waterMarkFile = "../vp_pics/vp_logo_w100_overlay.png";
  $waterMarkLocation = mt_rand(1,4); //1- �lal vasakul, 2 - �lal paremal, 3 - all paremal, 4 - all vasakul, 5 - keskel

  $waterMarkFromEdge = 10;
  $thumbW = 100;
  $thumbH = 100;
  $uploadOk = 1; 




  if(isset($_POST["submitPic"])){

// Check if file already exists

		/*if (file_exists($target_file)) {

			echo "Sorry, file already exists.";

			$uploadOk = 0;

		}*/		

		//kasutame klassi (saadame kogu info �leslaetava faili kohta ja faili mahu piiri

		$myPic = new PicUpload($_FILES["fileToUpload"], $fileSizeLimit);

		if($myPic->error == null){

			//loome failinime

			$myPic->createFileName($fileNamePrefix);

			//teeme pildi v�iksemaks

			$myPic->resizeImage($maxPicW, $maxPicH);


			$myPic->savePicFile($pic_upload_dir_thumb .$myPic->fileName);

			//salvestan originaali

			$notice .= " " .$myPic->saveOriginal($pic_upload_dir_front .$myPic->fileName);

						

			//salvestan info andmebaasi



		unset($myPic);

	}//kas nuppu klikiti

  }

  //pic upload l�ppeb

  

  require("header.php");

?>









<body>

  <?php

    echo "<h1>" .$userName ." koolit�� leht</h1>";

  ?>

  <p>See leht on loodud koolis �ppet�� raames ja ei sisalda t�siseltv�etavat sisu!</p>

  <hr>

  

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	  <label>Vali avalehele laetav pilt!</label>
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <br>
	  <label>Alt tekst: </label><input type="text" name="altText">
	  <br>
	  <input name="submitPic" type="submit" value="Lae pilt yles!"><span><?php echo $notice; ?></span>
	</form>
	<hr>
 <p>
<li><a href="home.php">Home</a></li>
 <li><a href="?logout=1">Logi V�lja</a></li>
 <li><a href="userprofile.php">Kasutaja profiil</a></li>
 <li><a href="messages.php">S�numid</a></li>
 <li><a href="changepass.php">Parooli vahetus</a></li>
 <li><a href="AB_andmebaas.php">AB andmebaas</a></li>
 <li><a href="picupload.php">Pildid Yles</a></li>
 <li><a href="publicgallery.php">Avalike piltide galerii</a></li>
 <li><a href="picupload_front.php">Esikuva piltide galerii</a></li>
 <li><a href="delPicGallery.php">Kustuta pilte</a></li>
 <li><a href="addNews.php">Uudised</a></li>
</p>

</body>


</html>