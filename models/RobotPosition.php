<?php


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
}