<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	  <title>Home Page</title>
    <script src="BoardGameHome.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        width: 70%;
        margin: auto;
    }
    </style>
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
                    <li><a class="active" href="#">Home</a></li>
                    <li><a href="games.php">Games</a></li>
                    <li><a href="forums.php">Forums</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li style="float:right;">
                        <form method="post" action="search.php">
                            <input class="glyphicon glyphicon-search" type="text" name="search" placeholder=" Search..">
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

    <!-- Put the carousel here -->
    <div class="container gray">
        <br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="http://gamingtrend.com/wp-content/screenshots/black-fleet/img_0674.jpg" alt="Board Game" style="width:700px;height:500px;">
                </div>

                <div class="item">
                    <img src="https://www.shutupandsitdown.com/wp-content/uploads/2014/03/bf4048e7ee6437d7c9fb4318d0e031ab.jpg" alt="Rampage" style="width:700px;height:500px;">
                </div>
    
                <div class="item">
                    <img src="https://i.kinja-img.com/gawker-media/image/upload/s--fOtZ-iNu--/c_scale,fl_progressive,q_80,w_800/1464500061578344995.jpg" alt="Imperial Assault" style="width:700px;height:500px;">
                </div>

                <div class="item">
                    <img src="http://www.boardgamequest.com/wp-content/uploads/2015/10/Pandemic-Legacy-Header.jpg" alt="Pandemic" style="width:700px;height:500px;">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="moreSpace">
            <h2>Board Game Brunch</h2>
            <p>
            Here at Board Game Brunch we love board games so much we would eat them if we could. This is the place to search out your next favorite game, or if you feel like you know it all and have some clever ideas then this is the place to come and discuss your board game thoughts, theories, and future ideas. He we collaberate, share, and hopefully soon demo future upcoming games.
            </p>
            <hr>
            <h3>Comming Soon!</h3>
            <p>
            We hope to soon have our weekly videos up and running, where we delve into board game concepts and desins specified in our forums. Check in soon to learn more!
            </p>
        </div>
    </div>

    <footer class="container-fluid text-center dark-gray">
        <a href="about.php"><h4 class="glyphicon glyphicon-info-sign"> About</h4></a>
    </footer>
  
</body>
</html>