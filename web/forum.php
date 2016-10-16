<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>Search results</h2>
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

		$result = $db->prepare("SELECT * FROM post WHERE forum_id LIKE '%$term%' ORDER BY parent_post_id");
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo $row['post'] . '<br>';
			echo "<br />\n";
		}


	?>
</body>
</html>