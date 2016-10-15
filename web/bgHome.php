<!DOCTYPE html>
<html>
<head>
	<title>Scripture Resources</title>
</head>
<body>
	<h1>Home Page</h1>
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

		print "<p>pgsql:<br>host=$dbHost<br>port=$dbPort<br>dbname=$dbName<br>user=$dbUser<br>pass=$dbPassword<br></p>\n\n";

		try {
			$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}

		$term pg_real_escape_string($_REQUEST['search']);

		$sql = "SELECT * FROM ".$dbName."WHERE Description LIKE '%".$term."%'";
		$r_query = pg_query($sql);
		
		while ($row = pg_fetch_array($r_query)) {
			echo $row[1];
		}
	?>
</body>
</html>