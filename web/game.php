<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>A Game</title>
</head>
<body>
	<a href="BoardGameHome.php">Home</a>
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

		$term = pg_escape_string($_REQUEST['name']);

		$result = $db->prepare("SELECT * FROM game WHERE game_title = '$term'");
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo '<h1>' . $row['game_title'] . '</h1><br>';
			echo '<h2>' . $row['game_subtitle'] . '</h2><br>';
			echo '<p>' . $row['game_description'] . '</p><br>';
			echo "<br />\n";
		}
	?>
</body>
</html>