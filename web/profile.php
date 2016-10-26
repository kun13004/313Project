<?php
session_start();
  

		try {
			$db = pg_connect('host=ec2-54-243-54-21.compute-1.amazonaws.com dbname=d1ci1fmm9irifj user=hugtqfrjvkgjma password=7dj1BOGitBNwtoO_b0dJzI9Jfg');
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}

		$term1 = pg_escape_string($_REQUEST['username']);
		$term2 = pg_escape_string($_REQUEST['password']);
		$hash_term2 = password_hash($term2, PASSWORD_DEFAULT);

		$query = "SELECT password FROM member WHERE user_name = '$term1'";
		$result = pg_query($db, $query);

		if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
        }

        $pass = pg_fetch_row($result);

        if (password_verify($term2, $pass[0])) {
        	$_SESSION["username"] = $term1;
        	header("Location: https://fathomless-plateau-18398.herokuapp.com/BoardGameHome.php");
		exit();
        }
        else {
        	header("Location: https://fathomless-plateau-18398.herokuapp.com/login.html");
		exit();
        }


		pg_close();


	?>
	<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>
<body>
</body>
</html>