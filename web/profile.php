<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
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

		try {
			$db = pg_connect('host=ec2-54-243-54-21.compute-1.amazonaws.com dbname=d1ci1fmm9irifj user=hugtqfrjvkgjma password=7dj1BOGitBNwtoO_b0dJzI9Jfg');
		}
		catch (PDOException $ex) {
 			print "<p>error: $ex->getMessage() </p>\n\n";
 			die();
		}

		$term1 = pg_escape_string($_REQUEST['username']);
		$term2 = pg_escape_string($_REQUEST['password']);
		$_SESSION["username"] = $term1;
		$hash_term2 = password_hash($term2, PASSWORD_DEFAULT);


		$result = $db->prepare("SELECT * FROM member WHERE user_name = '$term1' AND password = '$term2'");
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo '<h2>' . $row['first_name'] . '</h2><br>';
			echo '<h2>' . $row['last_name'] . '</h2><br>';
			echo '<p>' . $row['user_name'] . $row['email'] . '</p><br>';
			echo "<br />\n";
		}

		pg_close();

		header("Location: https://fathomless-plateau-18398.herokuapp.com/BoardGameHome.html");
	?>
</body>
</html>