<?php
namespace Arena;

class Arena {
  public $board;
  public $robots;

  private $positions;
  private $initialPositions;
  private $lives;

  private $winner = false;
  private $loser = false;

  public function __construct($ascii_board, $robots) {

    $this->loadBoard($ascii_board);

    $this->positions = [];

    foreach ($robots as $robot) {
      if (!($robot instanceof \Arena\Robot)) {
        throw new \Exception(get_class($robot) . " is not correct");
      }
      $initialPos = array_shift($this->initialPositions);
      list($x, $y, $robot_id) = $initialPos;
      $this->positions[$robot_id] = new RobotPosition($x, $y, "N");
      $this->robots[$robot_id] = $robot;
      $this->lives[$robot_id] = 10;
    }
  }

  	public function getRobotDirection($robot)
	{
		return $this->positions[$robot]->getDirection();
	}

  private function loadBoard($ascii_board) {
    $ascii_rows = explode("\n", $ascii_board);
    $this->board = array_map(function ($row) {
      return str_split($row);
    }, $ascii_rows);

    foreach ($this->board as $y => $row) {
      foreach ($row as $x => $case) {
        if (!in_array($case, [" ", "x"])) {
          $this->initialPositions[$case] = [$x, $y, $case];
          $this->board[$y][$x] = " ";
        }
      }
    }
  }

  public function getSummary() {
    $summary = [];
    foreach ($this->robots as $id => $robot) {
      $summary[$id] = ["class" => get_class($robot),
        "life" => $this->lives[$id],
        "position" => $this->positions[$id],
      ];
    }
    return $summary;
  }

  public function canAdvance($position) {
    $y = $position->getY();
    $x = $position->getX();
    switch ($position->getDirection()) {
      case "N":
        $y = $y - 1;
        break;
      case "S":
        $y = $y + 1;
        break;
      case "W":
      $x=$x-1;
      break;
      case "E":
      $x=$x+1;
      break;
    }
    
    $trial = ($this->board[$y][$x]) === ' ';

    return $trial;
  }

  public function getSurroundings($position) {
    $surroundings = [];
    $x = $position->getX();
    $y = $position->getY();

    for ($j = $y - 2; $j <= $y + 2; $j++) {
      $row = [];
      for ($i = $x - 2; $i <= $x + 2; $i++) {
        $has_robot = $this->isRobotAt($i, $j);
        $row[] = $has_robot ? $has_robot : $this->board[$j][$i];
      }
      $surroundings[] = $row;
    }
    return $surroundings;
  }

  private function isRobotAt($x, $y) {
    $has_robot = false;
    foreach ($this->positions as $id => $position) {
      if ($position->getX() == $x
        && $position->getY() == $y
      ) {
        $has_robot = $id;
      }
    }
    return $has_robot;
  }

  public function drawBoard() {
    foreach ($this->board as $y => $row) {
      foreach ($row as $x => $case) {
        $has_robot = $this->isRobotAt($x, $y);
        if ($has_robot) {
          echo $has_robot;
        } else {
          echo $case;
        }

      }
      echo "\n";
    }
  }

  public function fire($shooter) {
    // get position and facing
    $x = $this->positions[$shooter]->getX();
    $y = $this->positions[$shooter]->getY();
    $dir = $this->positions[$shooter]->getDirection();

    foreach ($this->positions as $victim => $position) {
      if ($victim == $shooter) {
        // don't shoot yourself
        continue;
      }
      switch ($dir) {
        case 'N':
          if ($position->getY() < $y && $position->getX() == $x) {
            // victim gets hit
            $this->hit($shooter, $victim);
            return $victim;
          }
          break;
        case 'E':
          if ($position->getX() > $x && $position->getY() == $y) {
            $this->hit($shooter, $victim);
            return $victim;
          }
          break;
        case 'S':
          if ($position->getY() > $y && $position->getX() == $x) {
            $this->hit($shooter, $victim);
            return $victim;
          }
          break;
        case 'W':
          if ($position->getX() < $x && $position->getY() == $y) {
            $this->hit($shooter, $victim);
            return $victim;
          }
          break;
      }
      return false;
    }
  }

  public function hit($shooter, $victim) {

    $this->lives[$victim] = $this->lives[$victim] - 1;
    $this->robots[$victim]->postHit($this->positions[$shooter]->getDirection());
  }

  public function turn() {
    // on a les positions des robots
    // on informe les robots de ce qui se trouve autour d'eux
    if($this->winner){
       throw new WinningCondition(
              "{$this->loser} est mort. {$this->winner} a gagné.", 
              $this->robots[$this->winner]);
       return [];
    }

    $turn_report = [];

    foreach ($this->robots as $id => $robot) {
      $position = $this->positions[$id];
      $surroundings = $this->getSurroundings($position);
      $robot->setSurroundings($position, $surroundings);
      // on demande un ordre au robot
      $move = $robot->requestMove();
      switch ($move) {
        case RobotOrder::TURN_LEFT:
          $this->positions[$id]->rotate('left');
          $turn_report[] = "$id turns left";
          break;
        case RobotOrder::TURN_RIGHT:
          $this->positions[$id]->rotate('right');
          $turn_report[] = "$id turns right";
          break;
        case RobotOrder::AHEAD:
          if ($this->canAdvance($position)) {
            $this->positions[$id]->ahead(true);
            $turn_report[] = "$id goes ahead";
          } else {
            $turn_report[] = "$id is blocked";
          }
          break;
        case RobotOrder::FIRE:
          $turn_report[] = "$id fires";
          $victim = $this->fire($id);
          if ($victim) {
            $turn_report[] = "$victim is hit";
          }
          if ($victim && $this->lives[$victim] <= 0) {
            $this->winner = $id;
            $this->loser = $victim;
            throw new WinningCondition(
              "$victim est mort. $id a gagné.",
              $this->robots[$id]);
          }
          break;
        default:
        case RobotOrder::WAIT:
          $turn_report[] = "$id awaits";
          break;
      }

    }
    return $turn_report;
  }

}
