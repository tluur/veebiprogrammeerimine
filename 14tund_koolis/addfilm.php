<?php
	require("../../../config_vp.php");
	require("functions_film.php");
	$userName = "Taavi";
	$database = "if19_taavi_lu_1";
	
	//var_dump($_POST);
	//kui on nuppu vajutatud
	if(isset($_POST["submitFilm"])){
		//salvestame kui vähemalt pealkiri on olemas
		if(!empty($_POST["filmTitle"])){
		$saveFilmInfo($_POST["filmTitle"], $_POST["filmYear"], $_POST["filmDuration"],
		$_POST["filmGenre"], $_POST["filmCompany"], $_POST["filmDirector"]);
		}
	}
	
	//lisame lehe päise
	//require("header.php");
	 
?>

<body background="bg.gif">
<?php
	echo "<h1>" .$userName ." koolitöö leht</h1>"
  
?>
<p><b>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiselt võetavat sisu !</b></p>
<hr>
<h2>Eesti filmid, lisame uue :</h2>
<p>Täida kõik failid ja lisa film andmebaasi : </p>
<form method ="POST">
 <label>Sisesta pealkiri : </label><input type ="text" name="filmTitle">
 <br>
 <label>Filmi tootmisaasta : </label><input type ="number" min="1912" max="2019"
 value="2019" name ="filmYear">
 <br>
 <label>Filmi kestus (min) : </label><input type ="number" min="1" max="300"
 value="80" name="filmDuration">
 <br>
  <label>Filmi zanr : </label><input type ="text" name="filmGenre">
  <br>
  <label>Filmi tootja : </label><input type ="text" name="filmCompany">
  <br>
  <label>Filmi lavastaja : </label><input type ="text" name="filmDirector">
  <br>
  <input type="submit" value="Salvesta filmi info" name="submitFilm">
</form>
<?php
	//echo "Server: ".$serverHost .", kasutaja: " .$serverUsername;
	//echo $filmifhoHTML;
?>
</p>

<hr>

</body>
</html>



//kodus SQL päringud ja siis läbi kuvada neid veebilehel.
//anda veateadet kui mõni lahter on tühi (veateade )











