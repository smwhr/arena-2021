<?php
require("../vendor/autoload.php");
// require('../public/index.php');


var_dump('eliott');

if(isset($_POST['restart'])){
  unset($_SESSION['arena']);
  header('Location: '.$_SERVER['REQUEST_URI']);
  exit;
} 

// if(isset($_POST['RESET']) || isset($_GET['RESET'])){
//   unset($_SESSION['arena']);
//   header('Location: '.$_SERVER['REQUEST_URI']);
//   exit;
// }

if(!isset($_SESSION['arena'])){

  $classA = "Robot\\".($_POST['class_A'] ?? "DefaultRobot");
  $classB = "Robot\\".($_POST['class_B'] ?? "DefaultRobot");

  $robotA = new $classA();
  $robotB = new $classB();
  $arena = new Arena\Arena($ascii_board, [$robotA, $robotB]);
}else{
  $arena = unserialize($_SESSION['arena']);
}

// try{
  $turn_report = $arena->turn();
// }catch(Arena\WinningCondition $wc){
  // $turn_report[] = $wc->getMessage();
// }


//don't forget to save to session the new state
$_SESSION['arena'] = serialize($arena);