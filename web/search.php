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

		$query1 = "SELECT game_title FROM game WHERE game_title LIKE '%$term%' OR game_subtitle LIKE '%$term%' OR game_description LIKE '%$term%'";

		$query2 = "SELECT forum.topic FROM forum INNER JOIN post ON forum.id = post.forum_id WHERE post.post LIKE '%$term%'";

		$result1 = pg_query($db, $query1);
		

		while ($row = pg_fetch_row($result1)) {
			$id = $row[0];
			echo '<a href="game.php?name=$id">' . $row[0] . '</a><br>';
			echo "<br />\n";
		}

		$result2 = pg_query($db, $query2);

		while ($row2 = pg_fetch_row($result2)) {
			$id = $row2[0];
			echo '<a href="forum.php?name=$id">' . $row2[0] . '</a><br>';
			echo "<br />\n";
		}

	?>
</body>
</html>