<?php
	require("../../../config_vp.php");
	require("functions_film.php");
	$userName = "Taavi";
	$database = "if19_taavi_lu_1";
		
	$filmifhoHTML = readAllFilms();
	
	
	//lisame lehe päise
	//require("header.php");
	 
?>

<body background="bg.gif">
<?php
	echo "<h1>" .$userName ." koolitöö leht</h1>"
 
?>
<p><b>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiselt võetavat sisu !</b></p>
<hr>
<h2>Eesti Filmid</h2>
<p>Praegu on andmebaasis järgmised filmid : </p>
<?php
	//echo "Server: ".$serverHost .", kasutaja: " .$serverUsername;
	echo $filmifhoHTML;
?>
</p>

<hr>

</body>
</html>















