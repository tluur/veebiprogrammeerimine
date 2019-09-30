<!DOCTYPE html> 
<html lang="et">
<head> 
	<meta charset="utf-8">
 	<title>Andrus Rinde progeb veebi</title> 
</head>

<body>
  <h1>Andrus Rinde koolitöö leht</h1>  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <h2>Eesti filmid, lisame uue</h2>
  <p>Täida kõik failid ja lisa film andmebaasi:</p>
  <form method="POST">
    <label>Sisesta pealkiri: </label><input type="text" value="" name="filmTitle">
	<br>
	<label>Filmi tootmisaasta: </label><input type="number" min="1912" max="2019" value="2019" name="filmYear">
	<br>
	<label>Filmi kestus (min): </label><input type="number" min="1" max="300" value="80" name="filmDuration">
	<br>
	<label>Filmi žanr: </label><input type="text" value="" name="filmGenre">
	<br>
	<label>Filmi tootja: </label><input type="text" value="" name="filmCompany">
	<br>
	<label>Filmi lavastaja: </label><input type="text" value="" name="filmDirector">
	<br>
	<input type="submit" value="Salvesta filmi info" name="submitFilm">
  </form>
  
  <p></p></body>
</html>





