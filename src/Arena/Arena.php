<?php
namespace Arena;

class Arena{
  public $board;
  public $robots;

  private $winner;
  private $positions;
  private $initialPositions;
  
  private $lives;

  public function __construct($ascii_board, $robots){

    $this->loadBoard($ascii_board);

    $this->positions = [];

    foreach($robots as $robot){
      if(!($robot instanceof \Arena\Robot)){
        throw new \Exception(get_class($robot)." is not correct");
      }

      $initialPos = array_shift($this->initialPositions);
      list($x, $y, $robot_id) = $initialPos;
      $this->positions[$robot_id] = new RobotPosition($x, $y, "N");
      $this->robots[$robot_id] = $robot;
      $this->lives[$robot_id]  = 100;
    }
  }

  private function loadBoard($ascii_board){
    $ascii_rows = explode("\n", $ascii_board);
    $this->board = array_map(function($row){
      return str_split($row);
    }, $ascii_rows);

    foreach($this->board as $y => $row){
      foreach($row as $x => $case){
        if(!in_array($case, [" ", "x"])){
          $this->initialPositions[$case] = [$x, $y, $case];
          $this->board[$y][$x] = " ";
        }
      }
    }
  }

  private function setWinner($winner){
      $this->winner = $winner;
  }
  private function getWinner($winner){
      return $this->winner;
  }

  public function canEnter($x, $y){
    return /* condition qui dit si c'est un point*/;
  }

  public function getSurroundings($position){
    $surroundings = [];
    $x = $position->getX();
    $y = $position->getY();

    for($j = $y - 2;  $j <= $y + 2 ; $j++){
      $row = [];
      for($i = $x - 2;  $i <= $x + 2 ; $i++){
        $has_robot = $this->isRobotAt($i, $j);
        $row[] = $has_robot ? $has_robot : $this->board[$j][$i];
      }
      $surroundings[] = $row;
    }
    return $surroundings;
  }

  public function getBoardSize(){
    //return size of board
  }

  public function askMove($robot){
    //logique qui déplace le robot en fonction de sa demande
  }

  private function isRobotAt($x, $y){
    $has_robot = false;
    foreach($this->positions as $id => $position){
      if(   $position->getX() == $x
        &&  $position->getY() == $y
      ){
        $has_robot = $id;
      }
    }
    return $has_robot;
  }

  public function drawBoard(){
    foreach($this->board as $y => $row){
      foreach($row as $x => $case){
        $has_robot = $this->isRobotAt($x, $y);
        if($has_robot){
          echo $has_robot;
        }else{
          echo $case;  
        }
        
      }
      echo "\n";
    }
  }

  public function fire($shooter){
    // get position and facing
    $x = $this->positions[$shooter].getX();
    $y = $this->positions[$shooter].getY();
    $dir = $this->positions[$shooter].getDirection();

    foreach ($this->positions as $victim => $position) {
      if ($victim == $shooter) {
        // don't shoot yourself
        continue;
      }
      switch ($dir) {
        case 'N':
          if ($position.getY() < $y) {
            // victim gets hit
            $this->hit($shooter, $victim);
          }
          break;
        case 'E':
          if ($position.getX() > $x) {
            $this->hit($shooter, $victim);
          }
          break;
        case 'S':
          if ($position.getY() > $y) {
            $this->hit($shooter, $victim);
          }
          break;
        case 'W':
          if ($position.getX() < $x) {
            $this->hit($shooter, $victim);
          }
          break;
      }
    }
  }

  public function turn(){
    // on a les positions des robots
    // on informe les robots de ce qui se trouve autour d'eux
    foreach($this->robots as $id => $robot){
      $position = $this->positions[$id];
      $surroundings = $this->getSurroundings($position);
      $robot->setSurroundings($position, $surroundings);
    
      // on demande un ordre au robot
      $move = $robot->requestMove();
      switch($move){
        case RobotOrder::TURN_LEFT:
          $this->positions[$id]->rotate('left');
          break;
        case RobotOrder::TURN_RIGHT:
          $this->positions[$id]->rotate('right');
          break;
        case RobotOrder::AHEAD:
          $tentativePosition = $this->positions[$id]->ahead();
          if($this->canEnter($tentativePosition)){
            $this->positions[$id]->ahead(true);
          }
          break;
        case RobotOrder::FIRE:
          $this->fire($id);
          break;
        default:
        case RobotOrder::WAIT:
          break;
      }

      // on compte les points, et on arrête si y a un winner
    }
    
  }

}