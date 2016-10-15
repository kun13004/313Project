<!DOCTYPE html>
<html>
<head>
	<title>Scripture Resources</title>
</head>
<body>
	<h1>Scripture Resources</h1>
	<form>
  		<input type="text" name="search" placeholder="Search..">
	</form>
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


		$result = $db->prepare('SELECT * FROM member');
		$result->execute();

		echo "<p>First Name  -  Last Name  -  Email  </p><br/>";
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo $row['first_name'] . ' - ' . $row['last_name'] . ' - ' . $row['email'];
			echo "<br />\n";
		}


	?>
</body>
</html>