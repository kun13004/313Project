<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
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

		$term1 = pg_escape_string($_REQUEST['username']);
		$term2 = pg_escape_string($_REQUEST['password']);


		$result = $db->prepare("SELECT * FROM member WHERE user_name = '$term1' AND password = '$term2'");
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo '<h2>' . $row['first_name'] . '</h2><br>';
			echo '<h2>' . $row['last_name'] . '</h2><br>';
			echo '<p>' . $row['user_name'] . $row['email'] . '</p><br>';
			echo "<br />\n";
		}
	?>
</body>
</html>