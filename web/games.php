<!DOCTYPE html>
<html>
<head>
	<title>Game List</title>
</head>
<body>
	<h1>List of games</h1>
	<?php
		// default Heroku Postgres configuration URL
		$dbUrl = getenv('DATABASE_URL');

		if (empty($dbUrl)) {
 		// example localhost configuration URL with postgres username and a database called cs313db
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
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}

		$result = $db->prepare("SELECT game_title, game_subtitle, game_description FROM game");
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo $row['game_title'] . '<br>';
			echo $row['game_description'] . '<br>';
			echo "<br />\n";
		}
	?>
</body>
</html>