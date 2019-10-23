<?php

namespace Arena;

class WinningCondition extends \Exception{
  private $winner;
  private $message;

  public function __construct($message, Robot $winner){
    $this->message = $message;
    $this->winner  = $winner;
  }

  public function getMessage(){
    return $this->message. "(".get_class($this->winner).")";
  }
}