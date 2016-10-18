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

		$result = $db->prepare(
			"SELECT f.topic, p.post, p.post_date, p.post_time, m.user_name 
			FROM post p 
			INNER JOIN forum f ON p.forum_id = f.id 
			INNER JOIN member m ON p.member_id = m.id 
			Where f.topic LIKE '%$term%' 
			ORDER BY p.id");
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