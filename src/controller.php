<?php
require("../vendor/autoload.php");
// require('../public/index.php');

if(isset($_POST['restart'])){
  unset($_SESSION['arena']);
} 

// if(isset($_POST['RESET']) || isset($_GET['RESET'])){
//   unset($_SESSION['arena']);
//   header('Location: '.$_SERVER['REQUEST_URI']);
//   exit;
// }


if(!isset($_SESSION['arena'])) {

  if (!empty($_POST["yourrobot"])) {
    $classA = "Robot\\".($_POST['yourrobot'] ?? "DefaultRobot");
  } else {
    $classA = "Robot\\"."DefaultRobot";
  }

  if (!empty($_POST["enemierobot"])) {
    $classB = "Robot\\".($_POST['enemierobot'] ?? "DefaultRobot");
  } else {
    $classB = "Robot\\"."DefaultRobot"; 
  }
  
  $robotA = new $classA();
  $robotB = new $classB();

  $arena = new Arena\Arena($ascii_board, [$robotA, $robotB]);
  $_SESSION['arena'] = serialize($arena);

  header('Location: '.$_SERVER['REQUEST_URI']);
  exit;

} else {
  $arena = unserialize($_SESSION['arena']);
}

try{
  $turn_report = $arena->turn();
}catch(\Arena\WinningCondition $wc){
  $turn_report = [$wc->getMessage()];
}


//don't forget to save to session the new state
$_SESSION['arena'] = serialize($arena);
