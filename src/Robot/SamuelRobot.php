<?php

namespace Robot;

class SamuelRobot implements \Arena\Robot {

  public function parseMap($surroundings) {
    $response = "";
    $i = 0;
    foreach ($surroundings as $row) {
      $j = 0;
      foreach ($row as $case) {
        if ($case === "x") {
          $response += "Mur à ";
        } elseif ($case !== " ") {
          $response += "Ennemi à  ";
        }
        $j += 1;
      }
      $i += 1;
    }
  }
  public function setSurroundings($position, $surroundings) {

  }

  public function requestMove() {
    $robotOrder = new \Arena\RobotOrder();
    $actions = [$robotOrder::TURN_LEFT,
      $robotOrder::TURN_RIGHT,
      $robotOrder::AHEAD,
      $robotOrder::FIRE,
      $robotOrder::WAIT];

    return $actions[array_rand($actions)];
  }
}
