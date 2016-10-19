<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		ini_set('display_errors','on');
		error_reporting(E_ALL);

 		//$dbUrl = "postgres://hugtqfrjvkgjma:7dj1BOGitBNwtoO_b0dJzI9Jfg@ec2-54-243-54-21.compute-1.amazonaws.com:5432/d1ci1fmm9irifj";
		

 		//echo "host=$dbHost <br> dbname=$dbName <br> user=$dbUser <br>password=$dbPassword";

		$db = pg_connect('host=ec2-54-243-54-21.compute-1.amazonaws.com dbname=d1ci1fmm9irifj user=hugtqfrjvkgjma password=7dj1BOGitBNwtoO_b0dJzI9Jfg');
		

		$first_name = pg_escape_string($_POST['firstname']);
		$last_name = pg_escape_string($_POST['lastname']);
		$country_code = pg_escape_string($_POST['country']);
		$area_code = pg_escape_string($_POST['area']);
		$phone_number = pg_escape_string($_POST['phone']);
		$phone_type = pg_escape_string($_POST['type']);
		$email = pg_escape_string($_POST['email']);
		$user_name = pg_escape_string($_POST['user_name']);
		$password = pg_escape_string($_POST['password']);


		$query = "INSERT INTO member(user_name, password, first_name, last_name, email) VALUES ('$user_name', '$password', '$first_name', '$last_name', '$email')";

		$result = pg_query($db, $query);

		if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
        } 
        printf ("These values were inserted into the database - %s %s %s", $user_name, $password, $first_name, $last_name, $email); 
        pg_close();

	?>
</body>
</html>