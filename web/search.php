<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
</head>
<body>
	<h2>Search results</h2>
	<?php
		ini_set('display_errors','on');
        error_reporting(E_ALL);

		try {
			$db = pg_connect('host=ec2-54-243-54-21.compute-1.amazonaws.com dbname=d1ci1fmm9irifj user=hugtqfrjvkgjma password=7dj1BOGitBNwtoO_b0dJzI9Jfg');
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}

		$term = pg_escape_string($_REQUEST['search']);

		$result = $db->prepare("SELECT * FROM game WHERE game_title LIKE '%$term%' OR game_subtitle LIKE '%$term%' OR game_description LIKE '%$term%'");

		$result2 = $db->prepare("SELECT forum.topic FROM forum INNER JOIN post ON forum.id = post.forum_id WHERE post.post LIKE '%$term%'");

		$result->execute();
		

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$id1 = $row['game_title'];
			echo '<a href="game.php?name=$id1">' . $row['game_title'] . '</a><br>';
			echo "<br />\n";
		}

		$result2->execute();

		while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
			$id2 = $row2['topic'];
			echo '<a href="forum.php?name=$id2">' . $row2['topic'] . '</a><br>';
			echo "<br />\n";
		}

	?>
</body>
</html>