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

  //v�ljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();

  }
  

  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  require("header.php");

  $notice = null;
  $fileName = "vp_";
  $picMaxW =  600;
  $picMaxH = 400;

  //pic upload algab
  //$target_dir = "uploads/";  

  if(isset($_POST["submitPic"])){
	var_dump($_FILES["fileToUpload"]);
	//$target_file = $pic_upload_dir_orig . basename($_FILES["fileToUpload"]["name"]);
	//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
	//Faili nime jaoks ajatempel
	$timeStamp = microtime(1) * 10000;
	$fileName .= $timeStamp ."." .$imageFileType;
	$target_file = $pic_upload_dir_orig .$fileName;
	
	$uploadOk = 1;
	
	// Kas on �ldse pilt
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			$notice = "Ongi pilt - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$notice = "Ei ole pilt!";
			$uploadOk = 0;
		}	
	// Check if file already exists
	if (file_exists($target_file)) {
		$notice = "Pilt juba serveris!";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 2500000) {
		$notice = "Kahjuks on fail liiga suur!";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$notice = "Kahjuks on lubatud ainult JPG, JPEG, PNG ja GIF failid!";
		$uploadOk = 0;
	}
	
	//Suuruse muutmine
	//loome ajutise "pildiobjekti" - image
	if($imageFileType == "jpg" or $imageFileType == "jpeg"){
		$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);		
	}
	
	if($imageFileType == "png" ){
		$myTempImage = imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);		
	}
	
	if($imageFileType == "gif" ){
		$myTempImage = imagecreatefromgif($_FILES["fileToUpload"]["tmp_name"]);		
	}
	
	//pildi originaal m��t
	$imageW = imagesx($myTempImage);
	$imageH = imagesy($myTempImage);
	
	//kui on liiga suur
	if($imageW > $picMaxW or $imageH > $picMaxH){
		//muudame suurust
		if($imageW / $picMaxW > $imageH / $picMaxH){
			$picSizeRatio = $imageW / $picMaxW;
		}else{
			$picSizeRatio = $imageH / $picMaxH;
		}
		//loome uue "pildiobjekti" juba uute m����tudega
		$newW = round($imageW / $picSizeRatio, 0);
		$newH = round($imageH / $picSizeRatio, 0);
		$myNewImage = setPicSize($myTempImage, $imageW, $imageH, $newW, $newH);
		//salvestan v�hendatud pildi faili
		if($imageFileType == "jpg" or $imageFileType == "jpeg"){
			if(imagejpeg($myNewImage, $pic_upload_dir_w600 .$fileName, 90)){
				$notice = "V�hendatud pildisalvestamine �nnestus ! ";
			} else {
				$notice = "V�hendatud pildisalvestamine eba�nnestus ! ";
			}
			
		}
		
			if($imageFileType == "png"){
			if(imagejpeg($myNewImage, $pic_upload_dir_w600 .$fileName, 6)){
				$notice = "V�hendatud pildisalvestamine �nnestus ! ";
			} else {
				$notice = "V�hendatud pildisalvestamine eba�nnestus ! ";
			}
			
		}
		
			if($imageFileType == "gif"){
			if(imagejpeg($myNewImage, $pic_upload_dir_w600 .$fileName)){
				$notice = "V�hendatud pildisalvestamine �nnestus ! ";
			} else {
				$notice = "V�hendatud pildisalvestamine eba�nnestus ! ";
			}
			
		}
		
	} //kui liiga suur l�ppeb
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$notice = "Kahjuks faili �les ei laeta!";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$notice .= "Originaalfail ". basename( $_FILES["fileToUpload"]["name"]). " laeti �les!";
		} else {
			$notice = "Vabandame, faili ei �nnestunud �les laadida!";
		}
	}
  }//nupuvajutuse kontroll  

  //pic upload l�ppeb  

  
?>


<body>

  <?php

    echo "<h1>" .$userName ." koolit�� leht</h1>";

  ?>

  <p>See leht on loodud koolis �ppet�� raames
  ja ei sisalda t�siseltv�etavat sisu!</p>
  <hr>
  <p>Tagasi <a href="home.php">avalehele</a></p>

  

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	  <label>Vali yleslaetav pilt!</label>
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <br>
	  <input name="submitPic" type="submit" value="Lae pilt �les"><span><?php echo $notice; ?></span>
	</form>

   <p><a href="?logout=1">Logi V�lja</a> |
 <a href="userprofile.php">Kasutaja profiil</a></p>
 <a href="home.php">Home</a></p>
  <a href="AB_andmebaas.php">AB andmebaas</a></p>
 <hr>
 <?php

 ?>

</body>

</html>

