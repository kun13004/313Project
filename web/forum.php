<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forum Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<!-- Header -->
  <ul>
    <li style="float:right;">
      <form method="post" action="search.php">
        <input type="text" name="search" placeholder="Search..">
      </form>
    </li>
  <?php
    $_SESSION["username"];
    $_SESSION["ftopic"];
    $log = $_POST["name"];
    if ($log == "logout") {
      $_SESSION["username"] = "";
    }
    if ($_SESSION["username"] != "") {
      echo '<li style="float:right"><p>Welcome ' . $_SESSION["username"] . '</p></li>';
      echo '<li style="float:right"><a href="logout.php">Log out</a></li>';
    }
    else {
      echo '<li style="float:right"><a href="login.html">Log in</a></li>';
      echo '<li style="float:right"><a href="signup.html">Sign up</a></li>';
    }
  ?>
      <li><a href="BoardGameHome.php">Home</a></li>
  		<li><a href="games.php">Games</a></li>
  		<li><a class="active" href="forums.php">Forums</a></li>
  		<li><a href="about.php">About</a></li>
	 </ul>
	
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
			echo $row[4] . "<br>";
			echo $row[2];
			echo "<br><br>";
		}

		

	?>
	<form action="newpost.php" method="post">
		<strong>New Post (You must have an account and be logged in to post)</strong><br>
		<textarea rows="10" cols="100" name="newpost"></textarea><br><br>
		<input type="submit" value="Submit">
	</form>
</body>
</html>