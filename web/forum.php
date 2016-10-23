<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
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

		/*
		$result = $db->prepare("SELECT forum.topic, post.post, post.post_date, post.post_time, member.user_name 
			FROM post 
			INNER JOIN forum ON post.forum_id = forum.id 
			INNER JOIN member ON post.member_id = member.id 
			WHERE forum.topic LIKE '%$term%'
			ORDER BY post.parent_post_id");*/
		function fetchPosts($db, $forum_id) {
			$sql = "WITH RECURSIVE cte (id, member_id, forum_id, parent_post_id, post, post_date, post_time) AS (
				SELECT id,
				post,
					array[id] AS path,
					parent_post_id,
					1 AS depth
				FROM post
				WHERE parent_post_id = NULL
				AND forum_id = :forum_id

				UNION ALL

				SELECT post.id,
					post.post,
					cte.path || post.id,
					post.parent_post_id,
					cte.depth + 1 AS depth
				FROM post
				JOIN cte ON post.parent_post_id = cte.id
				)
				SELECT id, post, path, depth FROM cte
			ORDER BY path";

		}

		$result->execute();

		echo $row['topic'];
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo $row['post'] . '<br>';
			echo $row['user_name'] . ' - ' . $row['post_date'] . $row['post_time'] . '<br>';
			echo "<br />\n";
		}
		

	?>
</body>
</html>