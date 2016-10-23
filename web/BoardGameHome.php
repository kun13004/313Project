<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body>
	<div class="header">
	<h1> Header Title </h1>
  <a href="#" onclick="<?php $_SESSION["username"] = ""; ?>">Log out</a>
  <?php
    $_SESSION["username"];
    if ($_SESSION["username"] != "") {
      echo '<p>Welcome ' . $_SESSION["username"] . '<p><br>';
    }
    else {
      echo '<a href="login.html">Log in/Sign up</a>';
    }
  ?>
	<form method="post" action="search.php">
  		<input type="text" name="search" placeholder="Search..">
  	</form>
  	<div>
  	<div>
  	
	<ul>
  		<li><a href="games.php">Games</a></li>
  		<li><a href="forums.php">Forums</a></li>
  		<li><a href="about.html">About</a></li>
	</ul>
	</form>
	</div>
</body>
</html>