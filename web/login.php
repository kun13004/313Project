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

		$first_name = filter_input(INPUT_POST, 'firstname');
		$last_name = filter_input(INPUT_POST, 'lastname');
		$country_code = filter_input(INPUT_POST, 'country');
		$area_code = filter_input(INPUT_POST, 'area');
		$phone_number = filter_input(INPUT_POST, 'phone');
		$phone_type = filter_input(INPUT_POST, 'type');
		$email = filter_input(INPUT_POST, 'email');
		$user_name = filter_input(INPUT_POST, 'user_name');
		$password = filter_input(INPUT_POST, 'password');



		$result = $db->prepare("INSERT INTO member (user_name, password, first_name, last_name, email) VALUES ('$user_name', '$password', '$first_name', '$last_name', '$email')");

		$result->execute();
		echo "Inserted new member<br>";
	?>
</body>
</html>