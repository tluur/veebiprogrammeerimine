<?php
	require("../../../config_vp.php");
	require("functions_film_paring.php");
	$userName = "Taavi";
	$database = "if19_taavi_lu_1";
	$filmSqlParing = sqlParing();
	
	//var_dump($_POST);
	//kui on nuppu vajutatud
	if(isset($_POST["saadaParing"])){
		//salvestame kui vähemalt pealkiri on olemas
		if(!empty($_POST["filmTitle"])){
		$sqlParing($_POST["filmDuration"], $_POST["filmYear"]);
		
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
<h2>Eesti filmid, päringud :</h2>
<p>Täida lahter ja saa vastus : </p>
<form method ="POST">
 <label>Väljalaske aasta alates : </label><input type ="number" min="1" max="2019" name="filmvaljalase">
 <br>
 <label>Kestuse järjekorras : </label><input type ="number" min="1" max="300"
  name ="filmKestus">
 <br>

  <input type="submit" value="Saada päring" name="saadaParing">
</form>
<hr>
<?php
	//echo "Server: ".$serverHost .", kasutaja: " .$serverUsername;
	//echo $filmifhoHTML;
?>
</p>
<?php

	echo $filmSqlParing;

?>
<hr>

</body>
</html>

