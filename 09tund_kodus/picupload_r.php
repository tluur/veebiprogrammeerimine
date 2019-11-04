<!DOCTYPE html> 
<html lang="et">
<head> 
	<meta charset="utf-8">
 	<title>kaks kaks progeb veebi</title> 
	<style> 
	 	 body{background-color: #000000; 
	 	 color: #a7eba9
	 }</style> 
</head>

<body>
  <h1>kaks kaks koolitöö leht</h1>  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  <hr>
  
  <form method="POST" action="/~rinde/2019/vp/ryhm-3/08tund/picupload.php" enctype="multipart/form-data">
	  <label>Vali üleslaetav pilt!</label>
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <br>
	  <input name="submitPic" type="submit" value="Lae pilt üles!"><span></span>
	</form>
	<hr>
</body>
</html>





