<?php

namespace Robot;

class RandomRobot implements \Arena\Robot{

  public function setSurroundings($position, $surroundings){
    //TODO
  }

  public function requestMove(){
    $robotOrder = new \Arena\RobotOrder();
		$actions = [$robotOrder::TURN_LEFT, 
			    $robotOrder::TURN_RIGHT, 
			    $robotOrder::AHEAD, 
			    $robotOrder::FIRE, 
			    $robotOrder::WAIT];

		return array_rand($actions);
  }
}
