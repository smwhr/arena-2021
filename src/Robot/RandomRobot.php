<?php

namespace Robot;

class RandomRobot implements \Arena\Robot{

  public function setSurroundings($position, $surroundings){
    //TODO
  }

  public function requestMove(){
    //TODO
	}
	
	public function chooseAction(){
		$robotOrder = new \Arena\RobotOrder();
		$actions = [$robotOrder->TURN_LEFT, $robotOrder->TURN_RIGHT, $robotOrder->AHEAD, $robotOrder->FIRE, $robotOrder->WAIT];

		$action = array_rand($actions);

		if ($action == $robotOrder->FIRE){
			$this->requestMove();
		}
		elseif ($action != $robotOrder->WAIT){
			$this->requestMove();
		}

	}
}