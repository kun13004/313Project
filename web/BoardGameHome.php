<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="BoardGameHome.js"></script>
</head>
<body>

  <!-- Header -->
  <ul>
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
      echo '<li style="float:right"><p>Welcome ' . $_SESSION["username"] . '</p></li>';
      echo '<li style="float:right"><a href="logout.php">Log out</a></li>';
    }
    else {
      echo '<li style="float:right"><a href="login.html">Log in</a></li>';
      echo '<li style="float:right"><a href="signup.html">Sign up</a></li>';
    }
  ?>
      <li><a class="active" href="#">Home</a></li>
  		<li><a href="games.php">Games</a></li>
  		<li><a href="forums.php">Forums</a></li>
  		<li><a href="about.php">About</a></li>
	 </ul>
  
</body>
</html>