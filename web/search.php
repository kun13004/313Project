<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
      			</button>
      			<a class="navbar-brand" href="#"><img style="width:25px;height: 25px;" src="http://sweaglesw.org/dicewizard/dice-icon.png"></a>
    		</div>
    		<div class="collapse navbar-collapse" id="myNavbar">
      			<ul class="nav navbar-nav">
        			<li><a href="BoardGameHome.php">Home</a></li>
        			<li><a href="games.php">Games</a></li>
        			<li><a href="forums.php">Forums</a></li>
        			<li><a href="about.php">About</a></li>
      			</ul>
      			<ul class="nav navbar-nav navbar-right">
        			<li style="float:right;">
        				<form method="post" action="search.php">
          					<input type="text" name="search" placeholder=" Search..">
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
            				echo '<li><a href="#"><span>Welcome ' . $_SESSION["username"] . '</span></a></li>';
            				echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>';
          				}
          				else {
            				echo '<li><a href="loginPage.php"><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>';
            				echo '<li><a href="signupPage.php"><span class="glyphicon glyphicon-log-in"></span> Sign up</a></li>';
          				}
        			?>
      			</ul>
    		</div>
  		</div>
	</nav>

	<div class="container-fluid text-center">
  		<div class="row content">
    		<div class="col-sm-2 sidenav clear">
    		</div>
    		<div class="col-sm-8 text-left gray">
    			<h1 class="tCenter">Search Results</h1>
      			<div class='list-group'>
    				<?php
						ini_set('display_errors','on');
        				error_reporting(E_ALL);

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

						$term = pg_escape_string($_REQUEST['search']);

						$result1 = $db->prepare("SELECT * FROM game WHERE game_title LIKE '%$term%' OR game_subtitle LIKE '%$term%' OR game_description LIKE '%$term%'");

						$result2 = $db->prepare("SELECT forum.topic FROM forum INNER JOIN post ON forum.id = post.forum_id WHERE post.post LIKE '%$term%'");

						$result1->execute();
		

						while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
							$id = $row['game_title'];
							echo "<a class='list-group-item' href='game.php?name=$id'>" . $row['game_title'] . "</a>";
							$id++;
						}

						$result2->execute();

						while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
							$id = $row['topic'];
							echo "<a class='list-group-item' href='forum.php?name=$id'>" . $row['topic'] . "</a>";
							$id++;
						}
					?>
				</div>
    		</div>
    		<div class="col-sm-2 sidenav clear">
    		</div>
  		</div>
	</div>

	<footer class="container-fluid text-center dark-gray">
  		<a href="about.php"><h4 class="glyphicon glyphicon-info-sign"> About</h4></a>
	</footer>

</body>
</html>