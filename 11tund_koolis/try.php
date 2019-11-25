<?php
  $userName = "Taavi Luur";
  $fullTimeNow = date("d.m.Y H:i:s"); 
  $hourNow = date("H");
  $partOfDay = " hägune aeg";
  if($hourNow < 8){
	  $partOfDay = "varane hommik";	  
  }
?>

<!DOCTYPE html>
<html lang="et">
<head>
<meta charset="utf-8">
<title>
	<?php
	  echo $userName;	
	?>
  esimene leht</title>
</head>
<body background="bg.gif">
<?php
  echo "<h1>" .$userName ." koolitöö leht</h1>"
?>
<p><b>Antud leht on loodud koolis õppetöö raames ja ei sisalda tõsiselt võetavat sisu !</b></p>
<hr>
<p>Lehe avamise hetkel oli aeg : 
<?php
  echo $fullTimeNow;
?>
.</p>
<?php
  echo "<p>Leheavanemise hetkel oli" .$partOfDay .
".</p>"; 
?>
<hr>
</body>
</html>