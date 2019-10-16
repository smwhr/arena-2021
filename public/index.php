<?php
	session_start();
	include("../data/board.php");
	include("../src/controller.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Robot Arena</title>
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>

		<h1>Robot Arena</h1>

		<pre id="board"><?php $arena->drawBoard();?></pre>

	</body>
	<script type="text/javascript" src="js/main.js"></script>
</html>