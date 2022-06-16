<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

if(isset($_POST["email"]) && isset($_POST["password"])){
		$errors = array();
		
		$email = $_POST["email"];
		$password = $_POST["password"];
		
		$db_user = 'basdekoningh'; //$db_user = 'dbu1897263';
		$db_pass = 'hahg5shohB'; //$db_pass = 'Buzzerguy13@';
		$db_host = 'localhost';//$db_host = 'rdbms.strato.de';
		$db_name = 'basdekoningh';//$db_name = 'dbs7006394';
		
		/* Open a connection */
		$mysqli = new mysqli("$db_host","$db_user","$db_pass","$db_name");

		if ($stmt = $mysqli->prepare("SELECT username, email, password FROM sc_users WHERE email = ? LIMIT 1")) {
			
			/* bind parameters for markers */
			$stmt->bind_param('s', $email);
				
			/* execute query */
			if($stmt->execute()){
				
				/* store result */
				$stmt->store_result();

				if($stmt->num_rows > 0){
					/* bind result variables */
					$stmt->bind_result($username_tmp, $email_tmp, $password_hash);

					/* fetch value */
					$stmt->fetch();
					
					if(password_verify ($password, $password_hash)){
						echo "Success" . "|" . $username_tmp . "|" .  $email_tmp;
						
						return;
					}else{
						$errors[] = "Wrong email or password.";
					}
				}else{
					$errors[] = "Wrong email or password.";
				}
				
				/* close statement */
				$stmt->close();
				
			}else{
				$errors[] = "Something went wrong, please try again.";
			}
		}else{
			$errors[] = "Something went wrong, please try again.";
		}
		
		if(count($errors) > 0){
			echo $errors[0];
		}
	}else{
		echo "Missing data";
	}

?>