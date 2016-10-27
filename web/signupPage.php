<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
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
      echo '<li style="float:right"><a class="active" href="signupPage.php">Sign up</a></li>';
    }
  ?>
      	<li><a href="BoardGameHome.php">Home</a></li>
  		<li><a href="games.php">Games</a></li>
  		<li><a href="forums.php">Forums</a></li>
  		<li><a href="about.html">About</a></li>
	</ul>

	<div>
	<h1>Sign up</h1>
	<form action="login.php" method="post">
		<strong>First Name</strong>
		<input type="text" name="firstname"><br><br>
		<strong>Last Name</strong>
		<input type="text" name="lastname"><br><br>
		<strong>Email</strong>
		<input type="text" name="email"><br><br>
		<strong>Username</strong>
		<input type="text" name="username"><br><br>
		<strong>Password</strong>
		<input type="password" name="password"><br><br>
		<input type="submit" value="Submit">
	</form>
  </div>
</body>
</html>