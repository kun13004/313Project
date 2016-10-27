<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
</head>
<body>
	<div>
	<a href="BoardGameHome.php">Home</a>
	<?php
		if ($_SESSION["username"] != "") {
      		echo "<p>Welcome " . $_SESSION["username"] . "<p><br>";
    	}
    ?>
	</div>
	<h2>Search results</h2>
	<?php
		ini_set('display_errors','on');
        error_reporting(E_ALL);

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

		$term = pg_escape_string($_REQUEST['search']);

		$result1 = $db->prepare("SELECT game_title FROM game WHERE game_title LIKE '%$term%' OR game_subtitle LIKE '%$term%' OR game_description LIKE '%$term%'");

		$result2 = $db->prepare("SELECT forum.topic FROM forum INNER JOIN post ON forum.id = post.forum_id WHERE post.post LIKE '%$term%'");

		$result1->execute();
		

		while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
			$id = $row['game_title'];
			echo '<a href="game.php?name=$id">' . $row['game_title'] . '</a><br>';
			echo "<br />\n";
			$id++;
		}

		$result2->execute();

		while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
			$id = $row2['topic'];
			echo '<a href="forum.php?name=$id">' . $row2['topic'] . '</a><br>';
			echo "<br />\n";
			$id++;
		}

	?>
</body>
</html>