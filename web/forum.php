<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
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

		$result1 = $db->prepare(
			"SELECT f.topic
			, p.post
			, p.post_date
			, p.post_time
			, m.user_name 
			FROM post p 
			INNER JOIN forum f ON p.forum_id = f.id 
			INNER JOIN member m ON p.member_id = m.id 
			Where p.parent_post_id = NULL AND f.topic LIKE '%$term%' 
			ORDER BY p.id");
		$result2 = $db->prepare("SELECT f.topic
			, p.post
			, p.post_date
			, FORMAT(p.post_time, 1)
			, m.user_name 
			FROM post p 
			INNER JOIN forum f ON p.forum_id = f.id 
			INNER JOIN member m ON p.member_id = m.id 
			Where p.parent_post_id != NULL AND f.topic LIKE '%$term%' 
			ORDER BY p.id");

		$result1->execute();
		$result2->execute();

		echo $row['topic'];
		while ($row1 = $result1->fetch(PDO::FETCH_ASSOC) || $row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
			echo $row1['post'] . '<br>';
			echo $row1['user_name'] . ' - ' . $row1['post_date'] . $row1['post_time'] . '<br>';
			echo "<br />\n";

			echo $row2['post'] . '<br>';
			echo $row2['user_name'] . ' - ' . $row2['post_date'] . $row2['post_time'] . '<br>';
			echo "<br />\n";
		}


	?>
</body>
</html>