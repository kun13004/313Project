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
		ini_set('display_errors','on');
        error_reporting(E_ALL);

		try {
			$db = pg_connect('host=ec2-54-243-54-21.compute-1.amazonaws.com dbname=d1ci1fmm9irifj user=hugtqfrjvkgjma password=7dj1BOGitBNwtoO_b0dJzI9Jfg');
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}

		$term = pg_escape_string($_REQUEST['name']);
		$_SESSION["ftopic"] = $term;
		
		$query = "SELECT forum.topic, post.post, post.post_date, post.post_time, member.user_name 
			FROM post 
			INNER JOIN forum ON post.forum_id = forum.id 
			INNER JOIN member ON post.member_id = member.id 
			WHERE forum.topic LIKE '%$term%'
			ORDER BY post.post_date, post.post_time";
		

		$result = pg_query($db, $query);

		while ($row = pg_fetch_row($result)) {
			echo $row[1] . "<br>";
			echo $row[2] . " ";
			echo $row[3] . " ";
			echo $row[4] . "<br>";
			echo "<br><br>";
		}

		

	?>
	<form action="newpost.php" method="post">
		<strong>New Post</strong><br>
		<textarea rows="10" cols="100" name="newpost"></textarea><br><br>
		<input type="submit" value="Submit">
	</form>
</body>
</html>