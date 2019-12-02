<?php
  require("../../../config_vp.php"); 
  require("functions_main.php");
  require("functions_user.php");
  require("functions_pic.php");
  $database = "if19_taavi_lu_1";
  $userName = "Sisselogimata kasutaja";
  //SESSIOON
  require("classes/Session.class.php");
  //sesioon, mis katkeb kui brauser suletakse ja on kätesaadav ainult meie domeenis meie lehelt
  SessionManager::sessionStart("vp", 0, "/~luurtaa", "greeny.cs.tlu.ee");
  
  $notice = "";
  $notice_priva = "";
  $email = "";
  $emailError = "";
  $passwordError = "";
  $randomImgHTML_C = "";
 
  $photoClassDir = "../picuploadw600h400/";
  $photoDir = "../photos/";
  $picFileTypes = ["image/jpeg", "image/png"];
  $fullTimeNow = date("d.m.Y H:i:s"); 
  $hourNow = date("H:i");
  $weekDaysET = array("Pühapäev", "Esmaspäev", "Teisipäev", "Kolmapäev", "Neljapäev", "Reede", "Laupäev");
  $monthET = array("Jaanuar", "Veebruar", "Märts", "Aprill", "Mai", "Juuni", "Juuli", "August", "September", "Oktoober", "November", "Detsember");
  $minutesNow = date("i");
  $laused = array('Täna on ilus päev', 'Tuleb vihma ja äikest', 'Peab koristama vist...');
  $rand = array_rand($laused);
  $semesterTeade = "";
  $semesterTeade = "";
  //http://greeny.cs.tlu.ee/phpmyadmin
  //log :if19
  //pass : ifikas2019
 
  if($hourNow < 06 and $hourNow > 00 ){
	  $partOfDay = "varajane hommik.";
  }
	  elseif ($hourNow < 11.59 and $hourNow > 06) {
		$partOfDay = "esimene pool päevast. ";
	  }
	  
	   elseif ($hourNow < 17.59 and $hourNow > 12.00) {
		$partOfDay = "teine pool päevast.";
	  }
	   
	    elseif ($hourNow < 23.59 and $hourNow > 18) {
		$partOfDay = "magama mineku aeg!";
	  }		  
		  
		  
		  
  if($minutesNow < 15) {
	  $partOfHours = " käims esimene veerandtund";
  }
	  elseif ($minutesNow > 16 && $minutesNow <= 29) {
		  $partOfHours = "lõppemas teine veerandtund";
		  
	  }
	  
	  elseif ($minutesNow > 30 && $minutesNow < 44) {
		  $partOfHours = "kolmas veerandtund";
		  
	  }
		  
	  elseif ($minutesNow > 45 && $minutesNow < 59) {
		  $partOfHours = "lõppemas käimasolev tund";
		  
      } 
	  //info semestri kulgemise kohta
	  $semesterStart = new DateTime("2019-9-2");
	  $semesterEnd = new DateTime("2019-12-13");
	  $semesterDuration = $semesterStart->diff($semesterEnd);
	  $today = new DateTime("now");
	  $fromSemesterStart = $semesterStart->diff($today);
	  //var_dump($fromSemesterStart);
	  $semesterInfoHTML = "<p> Siin peak polema info semestri kulgemise kohta</p>";
	  $elapsedValue = $fromSemesterStart->format("%r%a");
	  $durationValue = $semesterDuration->format("%r%a");
	  //echo $testValue;
	  //<meter min="0" max="155" value ="120">Väärtus</meter>
	  if($elapsedValue > 0){
		  $semesterInfoHTML = "<p>Semester on täies hoos: ";
		  $semesterInfoHTML .= '<meter min="0" max="' .$durationValue .'" ';
		  $semesterInfoHTML .= 'value="' .$elapsedValue .'">';
		  $semesterInfoHTML .= round($elapsedValue / $durationValue * 100, 1) ."%";
		  $semesterInfoHTML .="</meter>";
		  $semesterInfoHTML .="</p>";
	   if ($today < $semesterStart) {
		   
		   $semesterTeade = " Semester pole veel alanud ";
	   }
		   
		   elseif ($today > $semesterEnd) {
			   $semesterTeade = " Semester saigi läbi ! ";
		   }
	
	
	  }	 
	  // foto lisamine lehele
	  $allPhotos = [];
	  $dirContent = array_slice(scandir($photoDir), 2);
	  //var_dump($dirContent);
	  foreach  ($dirContent as $file){
		  $fileInfo = getimagesize($photoDir .$file);
		  //var_dump($fileInfo);
		  if(in_array($fileInfo["mime"], $picFileTypes) == true){
			  array_push($allPhotos, $file);
			  
		  }
	  }
	  	  
	  //var_dump($allPhotos);
	  $picCount = count($allPhotos);
	  $picNum = mt_rand(0, ($picCount - 1));
	  //echo $allPhotos[$picNum];
	  $photoFile = $photoDir .$allPhotos[$picNum];
	  $randomImgHTML = '<img src="' .$photoFile .'" alt="TLU Terra õppehoone">';
	  $latestPublicPictureHTML = latestPicture(1);
	  //lisame lehe päise
	 
	  $lala = null;
	  $lala = priva();
	 
	  //var_dump($allPhotos);
	  $picCount_l = count($lala);
	  $picNum_l = mt_rand(0, ($picCount_l - 1));
	  //echo $allPhotos[$picNum];
	  $photoFile_c = $photoClassDir .$lala[$picNum_l];
	  $randomImgHTML_C = '<img src="' .$photoFile_c .'" alt="pilt">';
	  //lisame lehe päise
		

	

	  
	  
	  if(isset($_POST["login"])){
		if (isset($_POST["email"]) and !empty($_POST["email"])){
		  $email = test_input($_POST["email"]);
		} else {
		  $emailError = "Palun sisesta kasutajatunnusena e-posti aadress!";
		}

	  

		if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
		  $passwordError = "Palun sisesta parool, vähemalt 8 märki!";
		}

	  

		if(empty($emailError) and empty($passwordError)){
		   $notice = signIn($email, $_POST["password"]);
		} else {
			$notice = "Ei saa sisse logida!";
		}

	  }
	  
	  $dayW = date("w");
	  $privacyClass = null;
	  $privacyClass = randomPicClass1();

	
?>
<!DOCTYPE html>
<html lang="et">
  <head>
    <meta charset="utf-8">
	<title>T koolitöö leht</title>
  </head>
<body background="bg.gif">
<?php
  echo "<h1>" .$userName ." koolitöö leht</h1>"
?>
<p><b>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiselt võetavat sisu !</b></p>
<hr>
<?php

echo "<p>Lehe avamise hetkel on aeg :" .$fullTimeNow .".</p>";
?>
</p>
<?php
  echo $weekDaysET[$dayW ] .date(" j. F");  
  echo $semesterInfoHTML; 
?>

<hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="email" value="<?php echo $email; ?>">&nbsp;<span><?php echo $emailError; ?></span><br>
	  <label>Salasõna:</label><br>
	  <input name="password" type="password">&nbsp;<span><?php echo $passwordError; ?></span><br>
	  <input name="login" type="submit" value="Logi sisse">&nbsp;<span><?php echo $notice ; ?>
	</form>
	<h>Loo kasutaja</h>
	<p>Loo endale meie lehe <a href="newuser.php">kasutajakonto </a></p>
<hr>
<?php

 echo $randomImgHTML ." ";
 //echo "<p>Käimas on " .$partOfDay ;
 echo $semesterTeade;
 //echo $lala;
 //echo $randomImgHTML_C;
 echo $latestPublicPictureHTML;
 
?>
</body>
</html>















