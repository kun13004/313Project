<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Game List</title>
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
      echo '<li style="float:right"><a href="loginPage.php">Log in</a></li>';
      echo '<li style="float:right"><a href="signupPage.php">Sign up</a></li>';
    }
  ?>
      <li><a href="BoardGameHome.php">Home</a></li>
  		<li><a class="active" href="games.php">Games</a></li>
  		<li><a href="forums.php">Forums</a></li>
  		<li><a href="about.php">About</a></li>
	 </ul>

	<!-- List the Games -->
	<h1>List of games</h1>
	<div class="gameList">
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

		$result = $db->prepare("SELECT * FROM game ORDER BY id");
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$id = $row['game_title'];
			echo "<div class='singleGameList'><a href='game.php?name=$id'>" . $row['game_title'] . " " . $row['game_subtitle'] . "</a></div>";
			$id++;
		}
	?>
	</div>
</body>
</html>