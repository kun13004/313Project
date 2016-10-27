<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forum List</title>
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
	
	<h1>List Forums</h1>
	<?php
		// default Heroku Postgres configuration URL
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

		$result = $db->prepare("SELECT topic FROM forum");
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$id = $row['topic'];
			echo "<a href='forum.php?name=$id'>" . $row['topic'] . "</a><br>";
			echo "<br />\n";
		}


	?>
</body>
</html>