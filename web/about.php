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
                    <li><a href="BoardGameHome.php">Home</a></li>
                    <li><a href="games.php">Games</a></li>
                    <li><a href="forums.php">Forums</a></li>
                    <li><a class="active" href="#">About</a></li>
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
            <div class="col-sm-8 text-left gray moreSpace">
                <h1>Welcome</h1>
                <p>
                    Board Game Brunch (the name isn't really solidified) is a website that I would like to eventually create someday. I know that this is a site too, but I mean a full blown site with it's own domain and where the games and forums are a bit more in depth. I would like to add weekly videos to the site and possibly incorporate a google hangouts sort of page for other board gamers to chat. This site is my php project for CS-313. It contains a database full of board games, forums, and members. Users can search for topics or key words found in game or forum pages, or go directly to the page list of games or forums.
                </p>
                <hr>
                <h3>Who am I</h3>
                <p>I am an aspiring computer scientist. I enjoy coding very much and have found that I do enjoy web developement a great deal. I have grown up in Idaho Falls most my life. My uncle introduced me to board games. Since then I have grown to love it and become somewhat of a fanatic on board games. I have a pretty good size collection of board games, although a can't say I'm anywhere close to what I hope to have in the future. I have a vast list of games that I want to own, but time and money permit me to chip away at that list slowly.</p>
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