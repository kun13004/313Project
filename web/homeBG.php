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
		$term = pg_escape_string($_REQUEST['search']);

		$result = $db->prepare("SELECT * FROM member WHERE first_name LIKE '%$term%' OR last_name LIKE '%$term%'");
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo 'First name: ' . $row['first_name'] . '<br>';
			echo 'Last name: ' . $row['last_name'] . '<br>';
			echo "<br />\n";
		}


	?>
</body>
</html>