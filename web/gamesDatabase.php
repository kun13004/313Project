<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <a href="addGame.php">Back to adding games</a>
	<?php

		//ini_set('display_errors','on');
        //error_reporting(E_ALL);
        $db = pg_connect('host=ec2-54-243-54-21.compute-1.amazonaws.com dbname=d1ci1fmm9irifj user=hugtqfrjvkgjma password=7dj1BOGitBNwtoO_b0dJzI9Jfg');


		$title = pg_escape_string($_POST['title']);
        $subtitle = pg_escape_string($_POST['subtitle']);
        $barcode = pg_escape_string($_POST['barcode']);
        $category = pg_escape_string($_POST['bgtype']);
        $description = pg_escape_string($_POST['description']);
        $category1 = (int)$category;

        // Inserts the values into the game table
        $queryNewGame = "INSERT INTO game(game_type, game_bar_code, game_title, game_subtitle, game_description) VALUES ('" . $category . "', '" . $barcode . "', '" . $title . "', '" . $subtitle . "', '" . $description . "') RETURNING id";

        // Complete the query
        $resultNewGame = pg_query($db, $queryNewGame);

        // Query 
        $queryAllGames = "SELECT game_title, game_subtitle, game_type, game_bar_code, game_description FROM game";

        // Complete the query
        $resultAllGames = pg_query($db, $queryAllGames);

        // Check if the query worked
        if (!$resultAllGames) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
        }

        // Display the query results
        while ($row = pg_fetch_row($resultAllGames)) {
        	$theCategory = "Nothing";
        	if ($row[2] == 1) {
        		$theCategory = "Dexterity";
        	}
        	elseif ($row[2] == 2) {
        		$theCategory = "Bluffing";
        	}
        	elseif ($row[2] == 3) {
        		$theCategory = "Worker Placement";
        	}
        	elseif ($row[2] == 4) {
        		$theCategory = "Dungeon Crawl";
        	}
        	elseif ($row[2] == 5) {
        		$theCategory = "Deck Building";
        	}

            echo "<h2>$row[0]</h2>"; 
            echo "<h3>$row[1]</h3>";
            echo "<p><b>Category:</b> $theCategory</p><br>";
            echo "<p><b>Barcode:</b> $row[3]</p><br/>";
            echo "<p><b>Description</b></p>";
            echo "<p>$row[4]</p><br>";
            echo "<br /><br />\n";
        }
        // close the database, this isn't
        // fully neccessary because the php
        // will close up everything on it's
        // own but this is good practice
        pg_close();
	?>
</body>
</html>