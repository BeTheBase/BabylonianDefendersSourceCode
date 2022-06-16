<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

		$errors = array();
		
		$db_user = 'basdekoningh'; //$db_user = 'dbu1897263';
		$db_pass = 'hahg5shohB'; //$db_pass = 'Buzzerguy13@';
		$db_host = 'localhost';//$db_host = 'rdbms.strato.de';
		$db_name = 'basdekoningh';//$db_name = 'dbs7006394';
		
		/* Open a connection */
		$mysqli = new mysqli("$db_host","$db_user","$db_pass","$db_name");
        
		if ($stmt = $mysqli->prepare("SELECT * FROM `highscores` ORDER BY `score`")) {
			
            

			/* execute query */
			if($stmt->execute()){
			
				/* store result */
				$stmt->store_result();

				if($stmt->num_rows > 0){
                    $myArray = array(); 
					$result = $mysqli->query("SELECT * FROM `highscores` ORDER BY `score`");

					while($row = $result->fetch_object()){
                        $myArray[] = $row;
                    }
                    echo json_encode($myArray, JSON_PRETTY_PRINT);
					/* fetch value */
					$stmt->fetch();
										
				}else{
					$errors[] = "incoming querry returns 0 ";
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

?>