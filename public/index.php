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

  <form action="index.php" method="post">
    <input type="text" name='yourrobot' placeholder="Your robot">
    <input type="text" name='enemierobot' placeholder="Your enemie robot">
    <input type="submit" name="restart" value="Do it again" />
  </form>
  
<pre><?php $arena->drawBoard();?></pre>

  
</body>
</html>


