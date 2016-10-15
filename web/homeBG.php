<!DOCTYPE html>
<html>
<head>
	<title>Scripture Resources</title>
</head>
<body>
	<h1>Scripture Resources</h1>
	<?php
		// default Heroku Postgres configuration URL
		$dbUrl = getenv('DATABASE_URL');

		if (empty($dbUrl)) {
 		// example localhost configuration URL with postgres username and a database called cs313db
 		$dbUrl = "postgres://postgres:password@localhost:5432/scriptures";
		}

		$dbopts = parse_url($dbUrl);

		//print "<p>$dbUrl</p>\n\n";

		$dbHost = $dbopts["host"]; 
 		$dbPort = $dbopts["port"]; 
 		$dbUser = $dbopts["user"]; 
 		$dbPassword = $dbopts["pass"];
 		$dbName = ltrim($dbopts["path"],'/');

		print "<p>pgsql:<br>host=$dbHost<br>port=$dbPort<br>dbname=$dbName<br>user=$dbUser<br>pass=$dbPassword<br></p>\n\n";

		try {
			$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}

		$result = pg_query($db, "SELECT book, chapter, verse, content FROM scriptures_table");
		
		while ($row = pg_fetch_row($result)) {
			echo "<p><b>$row[1] $row[2]:$row[3]<b> - \"$row[4]\"<p>";
			echo "<br />\n";
		}



	?>
</body>
</html>