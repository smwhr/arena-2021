<?php

namespace Robot;

class ShooterRobot implements \Arena\Robot{

  public function setSurroundings($position, $surroundings){
    //TODO
  }

  public function requestMove(){
    return \Arena\RobotOrder::FIRE;
  }
  
  public function postHit($from) {
    
  }
}
