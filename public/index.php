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
</head>
<body>

  <h1>Robot Arena</h1>

  
<pre><?php $arena->drawBoard();?></pre>

  
</body>
</html>


