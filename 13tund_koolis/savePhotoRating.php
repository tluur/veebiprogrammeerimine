<?php
	//võtame vastu saadetud info
	$rating = $_REQUEST["rating"];	
	$response = "läks hästi: " .$rating * 2;
	echo $response;