<?php

namespace Robot;

class AheadRobot implements \Arena\Robot{

  public function setSurroundings($position, $surroundings){
    //TODO
  }

  public function requestMove(){
    return \Arena\RobotOrder::AHEAD;
  }
  
  public function postHit() {
    
  }
}
