<?php

namespace Robot;

class ValuRobot implements \Arena\Robot {
  public $action;
  public $surroundings;
  public $direction;

  public function __construct() {
    $this->action = new \Arena\RobotOrder();
  }

  public function setSurroundings($position, $surroundings) {
    $this->surroundings = $surroundings;
    $this->direction = $position->getDirection();
  }

  public function requestMove() {

    while (' ' == $this->surroundings[1][2] && ' ' == $this->surroundings[3][2] && ' ' == $this->surroundings[2][1] && ' ' == $this->surroundings[2][3]) {
      return $this->action::AHEAD;
    }

    if ('N' == $this->direction) {

      if (' ' != $this->surroundings[1][2] && 'x' != $this->surroundings[1][2] || ' ' != $this->surroundings[0][2] && 'x' != $this->surroundings[0][2]) {
        return $this->action::FIRE;
      } elseif (' ' == $this->surroundings[1][2]) {
        return $this->action::AHEAD;
      }
      return $this->action::TURN_LEFT;

    } elseif ('S' == $this->direction) {

      if (' ' != $this->surroundings[3][2] && 'x' != $this->surroundings[3][2] || ' ' != $this->surroundings[4][2] && 'x' != $this->surroundings[4][2]) {
        return $this->action::FIRE;
      } elseif (' ' == $this->surroundings[3][2]) {
        return $this->action::AHEAD;
      }
      return $this->action::TURN_LEFT;

    } elseif ('W' == $this->direction) {

      if (' ' != $this->surroundings[2][1] && 'x' != $this->surroundings[2][1] || ' ' != $this->surroundings[2][0] && 'x' != $this->surroundings[2][0]) {
        return $this->action::FIRE;
      } elseif (' ' == $this->surroundings[2][1]) {
        return $this->action::AHEAD;
      }
      return $this->action::TURN_LEFT;
    } elseif ('E' == $this->direction) {

      if (' ' != $this->surroundings[2][3] && 'x' != $this->surroundings[2][3] || ' ' != $this->surroundings[2][4] && 'x' != $this->surroundings[2][4]) {
        return $this->action::FIRE;
      } elseif (' ' == $this->surroundings[2][3]) {
        return $this->action::AHEAD;
      }
      return $this->action::TURN_LEFT;
    }
  }

  public function postHit() {
    //TODO
  }
}
