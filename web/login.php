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
		ini_set('display_errors','on');
		error_reporting(E_ALL);

		$db = pg_connect('host=ec2-54-243-54-21.compute-1.amazonaws.com dbname=d1ci1fmm9irifj user=hugtqfrjvkgjma password=7dj1BOGitBNwtoO_b0dJzI9Jfg');
		

		$firstname = pg_escape_string($_POST['firstname']);
		$lastname = pg_escape_string($_POST['lastname']);
		$countrycode = pg_escape_string($_POST['country']);
		$areacode = pg_escape_string($_POST['area']);
		$phonenumber = pg_escape_string($_POST['phone']);
		//$phonetype = pg_escape_string($_POST['type']);
		$email = pg_escape_string($_POST['email']);
		$username = pg_escape_string($_REQUEST['username']);
		$password = pg_escape_string($_POST['password']);

		$query = "INSERT INTO member(user_name, password, first_name, last_name, email) VALUES ('" . $username . "', '" . $password . "', '" . $firstname . "', '" . $lastname . "', '" . $email . "')";

		$result = pg_query($db, $query);

		if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
        } 
        printf ("These values were inserted into the database - %s %s %s $s $s", $username, $password, $firstname, $lastname, $email); 
        pg_close();

	?>
</body>
</html>