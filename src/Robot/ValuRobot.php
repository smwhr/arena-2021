<?php

namespace Robot;

class ValuRobot implements \Arena\Robot {
  public $action;
  public $surroundings;
  public $direction;
  public $last_order;

  public function __construct() {
    $this->action = new \Arena\RobotOrder();
    $this->last_order = '';
  }

  public function setSurroundings($position, $surroundings) {
    $this->surroundings = $surroundings;
    $this->direction = $position->getDirection();
  }

  public function requestMove() {

    while ($this->last_order == '' && ' ' == $this->surroundings[1][2] && ' ' == $this->surroundings[3][2] && ' ' == $this->surroundings[2][1] && ' ' == $this->surroundings[2][3]) {
      return $this->action::AHEAD;
    }

    if ('N' == $this->direction) {

      if (' ' != $this->surroundings[1][2] && 'x' != $this->surroundings[1][2] || ' ' != $this->surroundings[0][2] && 'x' != $this->surroundings[0][2]) {
        return $this->action::FIRE;
      } elseif ($this->last_order == 'ahead') {
        $this->last_order = 'left';
        return $this->action::TURN_LEFT;
      } elseif ($this->last_order == 'left') {
        $this->last_order = 'fire';
        return $this->action::FIRE;
      } elseif ($this->last_order == 'fire') {
        $this->last_order = 'right';
        return $this->action::TURN_RIGHT;
      } elseif ($this->last_order == 'right') {
        if ('x' == $this->surroundings[1][2]) {
          $this->last_order = 'corner';
          return $this->action::TURN_LEFT;
        }
        $this->last_order = 'ahead';
        return $this->action::AHEAD;
      } elseif ($this->last_order == 'corner') {
        $this->last_order = 'new wall';
        return $this->action::FIRE;
      } elseif ($this->last_order == 'new wall') {
        $this->last_order = 'left';
        return $this->action::TURN_LEFT;
      } elseif (' ' == $this->surroundings[1][2]) {
        $this->last_order = 'ahead';
        return $this->action::AHEAD;
      }
      $this->last_order = 'left';
      return $this->action::TURN_LEFT;

    } elseif ('S' == $this->direction) {

      if (' ' != $this->surroundings[3][2] && 'x' != $this->surroundings[3][2] || ' ' != $this->surroundings[4][2] && 'x' != $this->surroundings[4][2]) {
        return $this->action::FIRE;
      } elseif ($this->last_order == 'ahead') {
        $this->last_order = 'left';
        return $this->action::TURN_LEFT;
      } elseif ($this->last_order == 'left') {
        $this->last_order = 'fire';
        return $this->action::FIRE;
      } elseif ($this->last_order == 'fire') {
        $this->last_order = 'right';
        return $this->action::TURN_RIGHT;
      } elseif ($this->last_order == 'right') {
        if ('x' == $this->surroundings[3][2]) {
          $this->last_order = 'corner';
          return $this->action::TURN_LEFT;
        }
        $this->last_order = 'ahead';
        return $this->action::AHEAD;
      } elseif ($this->last_order == 'corner') {
        $this->last_order = 'new wall';
        return $this->action::FIRE;
      } elseif ($this->last_order == 'new wall') {
        $this->last_order = 'left';
        return $this->action::TURN_LEFT;
      } elseif (' ' == $this->surroundings[3][2]) {
        $this->last_order = 'ahead';
        return $this->action::AHEAD;
      }
      $this->last_order = 'left';
      return $this->action::TURN_LEFT;

    } elseif ('W' == $this->direction) {

      if (' ' != $this->surroundings[2][1] && 'x' != $this->surroundings[2][1] || ' ' != $this->surroundings[2][0] && 'x' != $this->surroundings[2][0]) {
        return $this->action::FIRE;
      } elseif ($this->last_order == 'ahead') {
        $this->last_order = 'left';
        return $this->action::TURN_LEFT;
      } elseif ($this->last_order == 'left') {
        $this->last_order = 'fire';
        return $this->action::FIRE;
      } elseif ($this->last_order == 'fire') {
        $this->last_order = 'right';
        return $this->action::TURN_RIGHT;
      } elseif ($this->last_order == 'right') {
        if ('x' == $this->surroundings[2][1]) {
          $this->last_order = 'corner';
          return $this->action::TURN_LEFT;
        }
        $this->last_order = 'ahead';
        return $this->action::AHEAD;
      } elseif ($this->last_order == 'corner') {
        $this->last_order = 'new wall';
        return $this->action::FIRE;
      } elseif ($this->last_order == 'new wall') {
        $this->last_order = 'left';
        return $this->action::TURN_LEFT;
      } elseif (' ' == $this->surroundings[2][1]) {
        $this->last_order = 'ahead';
        return $this->action::AHEAD;
      }
      $this->last_order = 'left';
      return $this->action::TURN_LEFT;

    } elseif ('E' == $this->direction) {

      if (' ' != $this->surroundings[2][3] && 'x' != $this->surroundings[2][3] || ' ' != $this->surroundings[2][4] && 'x' != $this->surroundings[2][4]) {
        return $this->action::FIRE;
      } elseif ($this->last_order == 'ahead') {
        $this->last_order = 'left';
        return $this->action::TURN_LEFT;
      } elseif ($this->last_order == 'left') {
        $this->last_order = 'fire';
        return $this->action::FIRE;
      } elseif ($this->last_order == 'fire') {
        $this->last_order = 'right';
        return $this->action::TURN_RIGHT;
      } elseif ($this->last_order == 'right') {
        if ('x' == $this->surroundings[2][3]) {
          $this->last_order = 'corner';
          return $this->action::TURN_LEFT;
        }
        $this->last_order = 'ahead';
        return $this->action::AHEAD;
      } elseif ($this->last_order == 'corner') {
        $this->last_order = 'new wall';
        return $this->action::FIRE;
      } elseif ($this->last_order == 'new wall') {
        $this->last_order = 'left';
        return $this->action::TURN_LEFT;
      } elseif (' ' == $this->surroundings[2][3]) {
        $this->last_order = 'ahead';
        return $this->action::AHEAD;
      }
      $this->last_order = 'left';
      return $this->action::TURN_LEFT;
    }
  }

  public function postHit($from) {
    //TODO
  }
}
