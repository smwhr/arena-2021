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

  <fieldset>
    <legend>Recommencer ?</legend>
    <form action="index.php" method="post">
      A : <input type="text" name='yourrobot' placeholder="Your robot">
      B : <input type="text" name='enemierobot' placeholder="Your enemy robot">
      <input type="submit" name="restart" value="Do it again" />
    </form>
  </fieldset>
  
<pre><?php $arena->drawBoard();?></pre>

  
</body>
</html>


