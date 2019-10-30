<?php

namespace Robot;

class WallE implements \Arena\Robot{

  private $move = true;
  private $go = "N";
  private $position;
  private $previousPosition;

  private $alongWall = false;

  private $around;
  private $direction;

  private $mode = "move";

  // move | shoot | postshoot

  public function setSurroundings($position, $surroundings){

    $leftFor = [ "N" => "W", "E" => "N", "S" => "E", "W" => "S",];
    $rightFor = [ "N" => "E", "E" => "S", "S" => "W", "W" => "N",];

    $this->around = [
      "N" => $surroundings[1][2], "NN" => $surroundings[0][2],
      "S" => $surroundings[3][2], "SS" => $surroundings[4][2],
      "W" => $surroundings[2][1], "WW" => $surroundings[2][0],
      "E" => $surroundings[2][1], "EE" => $surroundings[2][4],
    ];
    $dir = $position->getDirection();
    $this->around["ahead"] = $this->around[$dir];
    $this->around["aheadahead"] = $this->around[$dir.$dir];
    $this->around["left"] = $leftFor[$dir];
    $this->around["right"] = $rightFor[$dir];

    $this->direction = $dir;

  }

  public function requestMove(){
    $ennemyAhead = !in_array($this->around["ahead"], [" ", "x"]) || !in_array($this->around["aheadahead"], [" ", "x"]);

    if($ennemyAhead){
      return \Arena\RobotOrder::FIRE;
    }

    if($this->around["ahead"] == "x"){
      $this->mode = "turnshoot";
      return \Arena\RobotOrder::TURN_RIGHT;
    }

    if($this->mode == "turnshoot"){
      $this->mode = "postturn";
      return \Arena\RobotOrder::FIRE;
    }

    if($this->mode == "postturn"){
      $this->mode = "move";
      return \Arena\RobotOrder::TURN_RIGHT;
    }

    if($this->mode == "move"){
      $this->mode = "shoot";
      if($this->move){
        return \Arena\RobotOrder::AHEAD;
      }else{
        return \Arena\RobotOrder::WAIT;
      }
    }

    if($this->mode == "shoot"){
      if(in_array($this->direction, ["N","S"])){
        return \Arena\RobotOrder::TURN_LEFT;
      }else{
        $this->mode = "postshoot";
        return \Arena\RobotOrder::FIRE;
      }
    }

    if($this->mode == "postshoot"){
      $this->mode = "move";
      return \Arena\RobotOrder::TURN_RIGHT;
    }
    
  }
  
  public function postHit($from) {
    //$this->move = false;
  }
}
