<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Add Board Game to Database</h1>
	<form action="gamesDatabase.php" method="post">
		<strong>Title</strong>
		<input type="text" name="title"><br><br>
		<strong>Subtitle</strong>
		<input type="text" name="subtitle"><br><br>
		<strong>Barcode</strong>
		<input type="text" name="image"><br><br>
		<strong>Image Url</strong>
		<input type="text" name="barcode"> example (BDGM*****) where * = int<br><br>
		<input type="radio" name="bgtype" value="1" checked> Dexterity<br>
  		<input type="radio" name="bgtype" value="2"> Bluffing<br>
  		<input type="radio" name="bgtype" value="3"> Worker Placement<br>
  		<input type="radio" name="bgtype" value="4"> Dungeon Crawl<br>
  		<input type="radio" name="bgtype" value="5"> Deck Building<br>
		<strong>Description</strong><br>
		<textarea rows="10" cols="100" name="description"></textarea><br><br>
		<input type="submit" value="Submit">
	</form>
</body>
</html>