<?php
include_once("../models/Robot.php");
include_once("../models/Arena.php");
include_once("../data/board.php");

$bender = new \Robot();
$tardis = new \Robot();

$arena = new Arena($ascii_board, [$bender, $tardis]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Robot Arena</title>
</head>
<body>

  <h1>Robot Arena</h1>

  
<pre><?php $arena->drawBoard();?></pre>

  
</body>
</html>


