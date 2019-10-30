<?php
namespace Arena;

interface Robot{
  public function setSurroundings($position, $surroundings);
  public function requestMove();
  public function postHit($from);
}