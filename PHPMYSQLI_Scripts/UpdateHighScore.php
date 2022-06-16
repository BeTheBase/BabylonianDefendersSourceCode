<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
	if(isset($_POST["username"]) && isset($_POST["score"])){

		$db_user = 'basdekoningh'; 
		$db_pass = 'hahg5shohB'; 
		$db_host = 'localhost';
		$db_name = 'basdekoningh';
		
		/* Open a connection */
		$mysqli = new mysqli("$db_host","$db_user","$db_pass","$db_name");

		$errors = array();

		$username = $_POST["username"];
		$score = $_POST["score"];

		//check if user exists
		$user = $mysqli->prepare("SELECT * FROM highscores where username='$username'");
		$user->fetch();

		if($user) {

			//$errors[] = "User does already exist" ;
			if ($stmt = $mysqli->prepare("UPDATE `highscores` Set score='".$score."' WHERE username='".$username."' && score<'".$score."'")) {

                    /* execute query */
				if($stmt->execute()){
					
					/* store result */
					$stmt->store_result();
					$stmt->fetch();
					/* close statement */
					$stmt->close();
					
				}else{
					$errors[] = "Something went wrong, please try again.";
				}
			}else{
				$errors[] = "Something went wrong, please try again.";
			}
		} else {
			// username does not exist

		 
		
		if(count($errors) == 0){

		

			
			if ($stmt = $mysqli->prepare("INSERT INTO `highscores` (`username`, `score`) VALUES ('$username', '$score')")) {

                    /* execute query */
				if($stmt->execute()){
					
					/* store result */
					$stmt->store_result();
					
					/* close statement */
					$stmt->close();
					
				}else{
					$errors[] = "Something went wrong, please try again.";
				}
			}else{
				$errors[] = "Something went wrong, please try again.";
			}

        }
	}

}
?>

				/* bind parameters for markers */
				$stmt->bind_param('ss', $username, $score);
					
				/* execute query */
				if($stmt->execute()){
					
					/* store result */
					$stmt->store_result();
					
					/* close statement */
					$stmt->close();
					
				}else{
					$errors[] = "Something went wrong, please try again.";
				}
			}else{
				$errors[] = "Something went wrong, please try again.";
			}
		}
		
		if(count($errors) == 0){
			if ($stmt = $mysqli->prepare("INSERT INTO highscores (username, score) VALUES(?, ?)")) {
				
				/* bind parameters for markers */
				$stmt->bind_param('ss', $username, $score);
					
				/* execute query */
				if($stmt->execute()){
					
					/* close statement */
					$stmt->close();
					
				}else{
					$errors[] = "Something went wrong, please try again.";
				}
			}else{
				$errors[] = "Something went wrong, please try again.";
			}
		}
		
		if(count($errors) > 0){
			echo $errors[0];
		}else{
			echo "Success";
		}
	}else{
		echo "Missing data";
	}
	
	function validate_email_address($email) {
		return preg_match('/^([a-z0-9!#$%&\'*+-\/=?^_`{|}~.]+@[a-z0-9.-]+\.[a-z0-9]+)$/i', $email);
	}
?>