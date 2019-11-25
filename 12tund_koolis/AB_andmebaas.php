<?php

require("../../../config_vp.php"); 
require("functions_main.php");
require("functions_user.php");
require("functions_AB.php");
$database = "if19_taavi_lu_1";
  
  $name = null;
  $surname = null;
  $email = null;
  $gender = null;
  $birthMonth = null;
  $birthYear = null;
  $birthDay = null;
  $birthDate = null;
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni","juuli", "august", "september", "oktoober", "november", "detsember"];
  
  //muutujad võimalike veateadetega
  $nameError = null;
  $surnameError = null;
  $birthMonthError = null;
  $birthYearError = null;
  $birthDayError = null;
  $birthDateError = null;
  $genderError = null;
  $emailError = null;
  $passwordError = null;
  $confirmpasswordError = null;
  

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
  $notice_roll = null;
  $notice_osaleja = null;
  $notice_ufID = null;
  $messagesHTML = null;
  $messagesHTML = readAll_AB();
  //$messagesHTML = readMyMessages();


  	if(isset($_POST["submitFilm_AB"])){
		//salvestame kui vähemalt pealkiri on olemas
		if(!empty($_POST["filmTitle"])){
		$notice = saveFilmInfo_AB($_POST["filmTitle"], $_POST["filmYear"], $_POST["filmDuration"],
		$_POST["filmIntro"]);
		}
	}
	
	if(isset($_POST["submitFilm_roll"])){
		if(!empty($_POST["amet"])){
		$notice_roll = saveFilmAmet($_POST["amet"]);
		}
		
	}
	
	if(isset($_POST["submitFilm_osal"])){
		if(!empty($_POST["firstName"])){
			$notice_osaleja = saveFilmOsaleja($_POST["firstName"], $_POST["surName"], $_POST["birthDate"]);
		}
		
	}
	
	if(isset($_POST["submitFilm_AB"])){
		if(!empty($_POST["firstName"])){
			$notice_ufID = userId_FilmId();
		}
		
	} 
	

  

 require("header.php");

?>


<body>

  <?php

    echo "<h1>" .$userName ." Andmebaaside sisu kuvav ja salvestav leht !</h1>";

  ?>
 
<hr>
  <p><h2>Filmibaasi salvestatav sisu!</h2></p>
  
 <form method ="POST">
 <label>Sisesta pealkiri : </label><input type ="text" name="filmTitle">
 <br>
 <label>Filmi tootmisaasta : </label><input type ="number" min="1912" max="2019"
 value="2019" name ="filmYear">
 <br>
 <label>Filmi kestus (min) : </label><input type ="number" min="1" max="300"
 value="80" name="filmDuration">

  <br>

  <textarea rows="5" cols="50" name="filmIntro" placeholder="Sisukokkuvõte ..."></textarea>
  <br>
  <input type="submit" value="Salvesta filmi info" name="submitFilm_AB">
</form>

<hr>

<p><h2>Filmides osalejate andmed!</h2></p>  
<form method ="POST">
	  <label>Eesnimi:</label><br><input name ="firstName" type="text" ><br>
      <label>Perekonnanimi:</label><br><input name="surName" type="text" ><br><p>
	  <label>Sünnikuupäev :</label><input type="date" name="birthDate">
	  
	  <br>
      <input type="submit" value="Salvesta filmi info" name="submitFilm_osal">
</form>

<hr>


  <p><h2>Rolli filmis!</h2></p>
  <form method ="POST">
  <label>Amet Filmis : </label><br><input type ="text" name="amet">
  <br>
  <input type="submit" value="Salvesta roll filmis" name="submitFilm_roll">
</form>
	  
 
<hr>
  <p><h2>Filmibaasi kuvatav sisu!</h2></p>
 
  <?php
 echo $messagesHTML;
 ?>
 
 
 <p>
 <a href="?logout=1">Logi VÃ¤lja</a> |
 <a href="userprofile.php">Kasutaja profiil</a></p>
 <a href="messages.php">SÃµnumid</a> |
 <a href="changepass.php">Parooli vahetus</a></p>
 <a href="AB_andmebaas.php">AB andmebaas</a> |
 <a href="picupload.php">Pildid Yles</a></p>
 <a href="publicgallery.php">Avalike piltide galerii</a> |
 <a href="picupload_front.php">Esikuva piltide galerii</a></p>
 <a href="delPicGallery.php">Kustuta pilte</a></p>
 <a href="home.php">Home</a></p> 
 <hr>


</body>

</html>

