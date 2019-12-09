<?php
	

	
	    function change_passwd($password_n, $password_n2){
        $notice_roll = null;
        $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $conn->prepare("SELECT id FROM vpusers3 WHERE id = ?");
        echo $conn->error;
        $stmt->bind_param("i", $_SESSION["userID"]);
        $stmt->bind_result($idFromDb);
        $stmt->execute();
        if($stmt->fetch()){
            $stmt->close();
			if($password_n == $password_n2){
            $stmt = $conn->prepare("UPDATE vpusers3 SET password = ? WHERE id = ?");           
            $options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
            $pwdhash = password_hash($password_n , PASSWORD_BCRYPT, $options);
            $stmt->bind_param("si", $pwdhash, $_SESSION["userID"]);
            if($stmt->execute()){
                $notice_roll = "Parooli muutmine ok!";
            } else {
                $notice_roll = "Parooli muutmisel not ok!" .$stmt->error;
            }
			
        
        $stmt->close();
        $conn->close();
        return $notice_roll;
      }
		}
		}