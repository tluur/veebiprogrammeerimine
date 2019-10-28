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
	  <label>Eesnimi:</label><br>
	  <input name ="firstName" type="text" ><br>
      <label>Perekonnanimi:</label><br>
	  <input name="surName" type="text" ><br><p>
	  <label>Sünnikuupäev :</label>
	  <?php
		//Sünnikuupäev
		echo '<select name="birthDay">' ."\n";
		echo "\t \t" .'<option value="" selected disabeld>päev</option>' ."\n";
		for($i = 1; $i < 32; $i ++){
			echo "\t \t" .'<option value="' .$i .'"';
			if($i == $birthDay){
				echo " selected";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "\t </select> \n";
		?>
		
		<label>Sünnikuu: </label>
	  <?php
	    echo '<select name="birthMonth">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthMonth){
				echo " selected ";
			}
			echo ">" .$monthNamesET[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  
	  <label>Sünniaasta: </label>
	  <?php
	    echo '<select name="birthYear">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthYear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br><p>
	  <label>Amet Filmis : </label><br>
	  <input type ="text" name="amet">
  
	  
	  
	  
  <br>
  <input type="submit" value="Salvesta filmi info" name="submitFilm_osal">
</form>
 
<hr>
  <p><h2>Filmibaasi kuvatav sisu!</h2></p>
 
  <?php
 echo $messagesHTML;
 ?>
 
 
 <p>Tagasi <a href="home.php">avalehele</a></p>
 <p><a href="?logout=1">Logi Välja</a> |
 <a href="userprofile.php">Kasutaja profiil</a></p>
 <a href="messages.php">Sõnumid</a> |
 <a href="changepass.php">Parooli vahetus</a></p>
 <a href="home.php">Home</a></p>
 <hr>


</body>

</html>

