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

  public function ahead(){
    switch($this->getDirection()){
      case "N":
      $this->y=$this->y+1;
      break;
      case "S":
      $this->y=$this->y-1;
      break;
      case "W":
      $this->y=$this->x+1;
      break;
      case "E":
      $this->y=$this->x-1;
      break;
    }
}

}
