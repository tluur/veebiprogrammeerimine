<?php
  $userName = "Taavi Luur";
  $fullTimeNow = date("d.m.Y H:i:s"); 
  $hourNow = date("H:i");
  $minutesNow = date("i");
 
  if($hourNow < 06 and $hourNow > 00 ){
	  $partOfDay = "varajane hommik .";
  }
	  elseif ($hourNow < 11.59 and $hourNow > 06) {
		$partOfDay = "esimene pool päevast käimas";
	  }
	  
	   elseif ($hourNow < 17.59 and $hourNow > 12.00) {
		$partOfDay = "teine pool päevast käimas";
	  }
	   
	    elseif ($hourNow < 23.59 and $hourNow > 18) {
		$partOfDay = "magama mineku aeg !";
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
<p>Lehe avamise hetkel on aeg : 
<?php
  echo $fullTimeNow;
?>
.</p>
<?php
  echo "<p>Käimas on " .$partOfDay .".</p>";
  
  echo "<p>On " .$partOfHours .".</p>"; 
?>
<hr>
</body>
</html>