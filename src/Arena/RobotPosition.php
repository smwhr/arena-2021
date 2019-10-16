<?php
namespace Arena;

class RobotPosition{
  private $x;
  private $y;
  private $direction;

  public function __construct($x, $y, $direction){
    $this->x = $x;
    $this->y = $y;
    $this->direction = $direction;
  }

  public function getX(){
    return $this->x;
  }
  public function getY(){
    return $this->y;
  }

  public function getDirection(){
    return $this->direction;
  }

  public function setDirection($direction){
    $this->direction=$direction;
  }

  public function rotate($direction){
    if($direction=="left"){
      switch($this->direction){
        case "N":
        $this->setDirection("O");
        break;
        case "O":
        $this->setDirection("S");
        break;
        case "S":
        $this->setDirection("E");
        break;
        case "E":
        $this->setDirection("N");
        break; 
      }
    }
    if($direction=="right"){
      switch($this->direction){
        case "N":
        $this->setDirection("E");
        break;
        case "E":
        $this->setDirection("S");
        break;
        case "S":
        $this->setDirection("O");
        break;
        case "O":
        $this->setDirection("N");
        break; 
      }
    }

    
  }
}
