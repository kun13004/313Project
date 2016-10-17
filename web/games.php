<!DOCTYPE html>
<html>
<head>
	<title>Game List</title>
</head>
<body>
	<h1>List of games</h1>
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

			if ($_POST['byName'] == 2) {
				$result = $db->prepare("SELECT game_type FROM game");
				$result->execute();
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					echo $row['game_type'] . '<br>';
					echo "<br />\n";
				}
			}
			else if ($_POST['byName'] == 1) {
				$result = $db->prepare("SELECT game_title FROM game");
				$result->execute();
				while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					echo $row['game_title'] . '<br>';
					echo "<br />\n";
				}
			}
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}
	?>
</body>
</html>