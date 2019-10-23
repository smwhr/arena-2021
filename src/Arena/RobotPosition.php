<?php
namespace Arena;

class RobotPosition
{
    private $x;
    private $y;
    private $direction;

    public function __construct($x, $y, $direction)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
    }

    public function getX()
    {
        return $this->x;
    }
    public function getY()
    {
        return $this->y;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    
    // Setter pour la direction du robot

    public function setDirection($direction)
    {
        $this->direction = $direction;
    }


    // Change la direction du robot en fonction de sa direction actuelle et de l'orientation dans laquelle il se tourne 
    
    public function rotate($orientation)
    {
        if ($orientation == "left") {
            switch ($this->direction) {
                case "N":
                    $this->setDirection("O");
                    break;
                case "O":
                    $this->setDirection("S");
                    break;
                case "S":
                    $this->setDirection("E");
                    break;
                case "E":
                    $this->setDirection("N");
                    break;
            }
        }
        if ($orientation == "right") {
            switch ($this->direction) {
                case "N":
                    $this->setDirection("E");
                    break;
                case "E":
                    $this->setDirection("S");
                    break;
                case "S":
                    $this->setDirection("O");
                    break;
                case "O":
                    $this->setDirection("N");
                    break;
            }
        }

    }

    public function ahead(){
      switch($this->getDirection()){
        case "N":
        $this->y=$this->y-1;
        break;
        case "S":
        $this->y=$this->y+1;
        break;
        case "W":
        $this->x=$this->x+1;
        break;
        case "E":
        $this->x=$this->x-1;
        break;
      }
    }
}