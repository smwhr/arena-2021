<?php
include_once("RobotPosition.php");

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
      $initialPos = array_shift($this->initialPositions);
      list($x, $y, $robot_id) = $initialPos;
      $this->positions[$robot_id] = new RobotPosition($x, $y, "N");
      $this->robots[$robot_id] = $robot;
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

  public function getBoardSize(){
    //return size of board
  }

  public function askMove($robot){
    //logique qui déplace le robot en fonction de sa demande
  }

  public function drawBoard(){
    foreach($this->board as $y => $row){
      foreach($row as $x => $case){
        $has_robot = false;
        foreach($this->positions as $id => $position){
          if(   $position->getX() == $x
            &&  $position->getY() == $y
          ){
            $has_robot = $id;
          }
        }
        if($has_robot){
          echo $has_robot;
        }else{
          echo $case;  
        }
        
      }
      echo "\n";
    }
  }
  

}