<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
	<a href="BoardGameHome.php">Home</a>
	<?php
		if ($_SESSION["username"] != "") {
      		echo "<p>Welcome " . $_SESSION["username"] . "<p><br>";
    	}
    ?>
	</div>
	<?php
		//ini_set('display_errors','on');
		//error_reporting(E_ALL);

		try {
			$db = pg_connect('host=ec2-54-243-54-21.compute-1.amazonaws.com dbname=d1ci1fmm9irifj user=hugtqfrjvkgjma password=7dj1BOGitBNwtoO_b0dJzI9Jfg');
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}
		

		$firstname = pg_escape_string($_POST['firstname']);
		$lastname = pg_escape_string($_POST['lastname']);
		$email = pg_escape_string($_POST['email']);
		$username = pg_escape_string($_REQUEST['username']);
		$password = pg_escape_string($_POST['password']);
		$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

		$query = "INSERT INTO member(user_name, password, first_name, last_name, email) VALUES ('" . $username . "', '" . $hashed_pass . "', '" . $firstname . "', '" . $lastname . "', '" . $email . "')";

		$result = pg_query($db, $query);

		if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
        } 
        //printf ("These values were inserted into the database - %s %s %s", $username, $hashed_pass, $firstname, $lastname, $email); 
        pg_close();

        header("Location: https://fathomless-plateau-18398.herokuapp.com/login.html");

	?>
</body>
</html>