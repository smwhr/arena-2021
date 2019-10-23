<?php

namespace Robot;

class SuicideRobot implements \Arena\Robot{

  private $move = true;

  public function setSurroundings($position, $surroundings){
    //TODO
  }

  public function requestMove(){

    if($this->move){
      return [
              \Arena\RobotOrder::AHEAD,
              \Arena\RobotOrder::TURN_LEFT
             ][mt_rand(0,1)];
    }else{
      return \Arena\RobotOrder::WAIT;
    }
    
  }
  
  public function postHit() {
    $this->move = false;
  }
}
