<?php

namespace Arena;

class WinningCondition extends \Exception{
  private $winner;
  protected $message;

  public function __construct($message, Robot $winner){
    $this->message = $message. "(".get_class($winner).")";
    $this->winner  = $winner;
  }
}