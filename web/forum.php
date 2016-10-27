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

		/*
		$result = $db->prepare("SELECT forum.topic, post.post, post.post_date, post.post_time, member.user_name 
			FROM post 
			INNER JOIN forum ON post.forum_id = forum.id 
			INNER JOIN member ON post.member_id = member.id 
			WHERE forum.topic LIKE '%$term%'
			ORDER BY post.parent_post_id");*/
/*
		$query = " WITH RECURSIVE all_posts AS (
  					SELECT  post, parent_post_id, id
    				FROM post
    				WHERE parent_post_id IS NULL
  					UNION
  					SELECT at.post, at.parent_post_id, at.id
    				FROM post at
    				JOIN all_posts a
      				ON (at.parent_post_id = a.id)
					)
					SELECT * FROM all_posts
					ORDER BY parent_post_id";
*/
		$query = "SELECT * FROM post
					WHERE parent_post_id IS NULL";

		$result = pg_query($db, $query);

		while ($row = pg_fetch_row($result)) {
			echo $row[0] . "<br>";
			echo $row[1] . " ";
			echo $row[2] . "<br>";
			echo "<br><br>";
		}

		

	?>
</body>
</html>