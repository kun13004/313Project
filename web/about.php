<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>About</title>
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
        <!-- Header -->
  
        
        <li><a href="BoardGameHome.php">Home</a></li>
        <li><a href="games.php">Games</a></li>
        <li><a href="forums.php">Forums</a></li>
        <li><a class="active" href="about.php">About</a></li>
   
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
    <div class="col-sm-2 sidenav">
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
    </div>
    <div class="col-sm-8 text-left">
      <h1>Welcome</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <hr>
      <h3>Test</h3>
      <p>Lorem ipsum...</p>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>




</body>
</html>