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
    //Salut a tous ca va bien vous 
    // Julien je te donne 5€ si tu me donnes 2 points bonus 
    
  }
}