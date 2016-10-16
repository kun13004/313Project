<!DOCTYPE html>
<html>
<head>
	<title>Scripture Resources</title>
</head>
<body>
	<?php
		// default Heroku Postgres configuration URL
		$dbUrl = getenv('DATABASE_URL');

		if (empty($dbUrl)) {
 		// example localhost configuration URL with postgres username and a database called cs313db
 		$dbUrl = "postgres://postgres:password@localhost:5432/scriptures";
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
		//$term = mysql_real_escape_string($_REQUEST['forums']); 
		$term = $_POST["search"];

		echo "$term";
		$result = $db->prepare('SELECT * FROM member WHERE first_name = $_POST["search"]');
		$result->execute();

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'];
			echo "<br />\n";
		}


	?>
</body>
</html>