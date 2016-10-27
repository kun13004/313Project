<?php
	session_start();

	ini_set('display_errors','on');
    error_reporting(E_ALL);

	try {
		$db = pg_connect('host=ec2-54-243-54-21.compute-1.amazonaws.com dbname=d1ci1fmm9irifj user=hugtqfrjvkgjma password=7dj1BOGitBNwtoO_b0dJzI9Jfg');
	}
	catch (PDOException $ex) {
 		print "<p>error: $ex->getMessage() </p>\n\n";
 		die();
	}

	if ($_SESSION["username"] = "") {
		header("Location: https://fathomless-plateau-18398.herokuapp.com/forum.php");
    	exit();
    }

    $query1 = "SELECT id FROM member WHERE user_name = '" . $_SESSION["username"] . "'";
    $result1 = pg_query($db, $query1);

    $query2 = "SELECT id FROM forum WHERE topic = '" . $_SESSION["ftopic"] . "'";
    $result2 = pg_query($db, $query2);


	$newpost = pg_escape_string($_REQUEST['newpost']);
	$member_id = pg_fetch_row($result1);
	$forum_id = pg_fetch_row($result2);
	

	$query3 = "INSERT INTO post(member_id, forum_id, post, post_date, post_time) VALUES ('" . $member_id . "', '" . $forum_id . "', '" . $newpost . "', CURRENT_DATE, CURRENT_TIME')";
	$result3 = pg_query($db, $query3);

	if (!$result) { 
        $errormessage = pg_last_error(); 
        echo "Error with query: " . $errormessage; 
        exit(); 
    } 
         
    pg_close();

    $id = $_SESSION["ftopic"];

    header("Location: https://fathomless-plateau-18398.herokuapp.com/forum.php?name=$id");
    exit();


?>
<!DOCTYPE html>
<html>
<head>
	<title>New Post</title>
</head>
<body>
</body>
</html>