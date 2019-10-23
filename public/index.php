<?php
	session_start();
	include("../data/board.php");
	include("../src/controller.php");

	$direction['directions'] = [
		"A" => $arena->getRobotDirection('A'),
		"B" => $arena->getRobotDirection('B'),
	];
	$direction = json_encode($direction);

	$file = 'data/data.json';
	if(file_exists($file))
	{
		unlink($file);
	}
	$data = fopen($file, 'a');
	fwrite($data, $direction);
	fclose($data);
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
		
		<script type="text/javascript" src="js/main.js"></script>
	</body>
</html>