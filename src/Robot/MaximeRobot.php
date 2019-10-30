<?php

namespace Robot;

class MaximeRobot implements \Arena\Robot{
    private $hasRobot;

  public function setSurroundings($position, $surroundings){
        for ($i=0; $i < count($surroundings); $i++) {
            for ($j=0; $j < count($surroundings[$i]); $j++) {
                if ($surroundings[$i][$j] != "x" && $surroundings[$i][$j] != " " && !($j == 2 && $i == 2)) {
                    $this->hasRobot = true;
                    return;
                }
            }
        }
        $this->hasRobot = false;
  }

  public function requestMove(){
    $robotOrder = new \Arena\RobotOrder();
    if ($this->hasRobot == true) {
        return $robotOrder::FIRE;
    }
    else {
        $actions = [$robotOrder::TURN_LEFT, 
			    $robotOrder::TURN_RIGHT, 
			    $robotOrder::AHEAD];

	    return $actions[array_rand($actions)];
    }
  }
  
  public function postHit($from) {
    echo "Tasukete Maxime-chan ! ಥ_ಥ";
  }
}