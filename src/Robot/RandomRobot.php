<?php

namespace Robot;

class RandomRobot implements \Arena\Robot{
private $position;
private $surroundings;

  public function setSurroundings($position, $surroundings){
   $position=$this->position;
    $surroundings=$this->surroundings;
   //TODO
  }

  public function requestMove(){
    $robotOrder = new \Arena\RobotOrder();
		$actions = [$robotOrder::TURN_LEFT, 
			    $robotOrder::TURN_RIGHT,
			    $robotOrder::AHEAD, 
			    $robotOrder::FIRE, 
			    $robotOrder::WAIT];

		return $actions[array_rand($actions)];
  }
  
  public function postHit($from) {
    
  }
}
