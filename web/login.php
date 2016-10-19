<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		$dbUrl = getenv('DATABASE_URL');

		if (empty($dbUrl)) {
 		$dbUrl = "postgres://hugtqfrjvkgjma:7dj1BOGitBNwtoO_b0dJzI9Jfg@ec2-54-243-54-21.compute-1.amazonaws.com:5432/d1ci1fmm9irifj";
		}

		$dbopts = parse_url($dbUrl);

		$dbHost = $dbopts["host"]; 
 		$dbPort = $dbopts["port"]; 
 		$dbUser = $dbopts["user"]; 
 		$dbPassword = $dbopts["pass"];
 		$dbName = ltrim($dbopts["path"],'/');

		try {
			$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}

		$first_name = pg_escape_string($_REQUEST['firstname']);
		$last_name = pg_escape_string($_REQUEST['lastname']);
		$country_code = pg_escape_string($_REQUEST['country']);
		$area_code = pg_escape_string($_REQUEST['area']);
		$phone_number = pg_escape_string($_REQUEST['phone']);
		$phone_type = pg_escape_string($_REQUEST['type']);
		$email = pg_escape_string($_REQUEST['email']);
		$user_name = pg_escape_string($_REQUEST['user_name']);
		$password = pg_escape_string($_REQUEST['password']);



		$result = $db->prepare("INSERT INTO member(user_name, password, first_name, last_name, email) VALUES ('$user_name', '$password', '$first_name', '$last_name', '$email')");

		//$result->bindParam(':user_name', $user_name, PDO::PARAM_STR, 100);
    	//$result->bindParam(':password', $password, PDO::PARAM_STR, 100);
    	//$result->bindParam(':first_name', $first_name, PDO::PARAM_STR, 100);
    	//$result->bindParam(':email', $email, PDO::PARAM_STR, 100);

		if ($result->execute()) {
			echo "Inserted new member<br>";
		}
	?>
</body>
</html>