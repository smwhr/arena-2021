<?php

namespace Robot;

class OtherRobot implements \Arena\Robot
{
    private $position;

    private $surroundings;

    public function setSurroundings($position, $surroundings)
    {
        $this->position = $position;
        $this->surroundings = $surroundings;
    }

    public function requestMove()
    {
        
        if ($this->canIMove() == false) {
            if (isset($_SESSION["initPosition"])) {
                if ($this->thereISAWall()!=null) {
                
                    $wall = $this->thereISAWall(); 
                    if (((sizeof($wall)) == 2)) {
                        if ($this->makeWallChoice($wall) == "turn_left") {
                            $_SESSION["last"] = "left";

                            return \Arena\RobotOrder::TURN_LEFT;

                        }
                        if ($this->makeWallChoice($wall) == "turn_right") {
                            $_SESSION["last"] = "right";

                            return \Arena\RobotOrder::TURN_RIGHT;

                        }
                        if ($this->makeWallChoice($wall) == "fire") {
                            $_SESSION["last"] = "fire";

                            return \Arena\RobotOrder::FIRE;

                        }
                        if ($this->makeWallChoice($wall) == "ahead") {
                            $_SESSION["last"] = "ahead";

                            return \Arena\RobotOrder::AHEAD;

                        }
                    }

                }
                $this->makeTurn();
                if ($this->makeTurn() == "turn_left") {
                    $_SESSION["last"] = "left";

                    return \Arena\RobotOrder::TURN_LEFT;

                }
                if ($this->makeTurn() == "turn_right") {
                    $_SESSION["last"] = "right";

                    return \Arena\RobotOrder::TURN_RIGHT;

                }
                if ($this->makeTurn() == "fire") {
                    $_SESSION["last"] = "fire";

                    return \Arena\RobotOrder::FIRE;

                }
                if ($this->makeTurn() == "ahead") {
                    $_SESSION["last"] = "ahead";

                    return \Arena\RobotOrder::AHEAD;

                }

            } else {
                if ($this->thereISAWall()) {
                    $_SESSION["initPosition"] = "atteint";
                }
            }

        } else {
            return \Arena\RobotOrder::FIRE;

        }
        return \Arena\RobotOrder::AHEAD;

    }

    private function makeWallChoice($wall)
    {
        $dir = $this->position->getDirection();
        if ($wall == ["mur en haut", "mur a droite"]) {
            $_SESSION["sens"] = "left";
            if ($dir == "E") {
                return \Arena\RobotOrder::TURN_RIGHT;

            }

            if ($dir == "S") {
                if ($_SESSION["last"] == "fire") {
                    return \Arena\RobotOrder::TURN_RIGHT;
                } else {
                    return \Arena\RobotOrder::FIRE;

                }

            }
            if ($dir == "W") {
                return \Arena\RobotOrder::AHEAD;
            }
        }
        if ($wall == ["mur en haut", "mur a gauche"]) {
            $_SESSION["sens"] = "right";
            if ($dir == 'W') {
                return \Arena\RobotOrder::TURN_LEFT;
            }
            if ($dir == "S") {
                if ($_SESSION["last"] == "fire") {
                    return \Arena\RobotOrder::TURN_LEFT;
                } else {
                    return \Arena\RobotOrder::FIRE;

                }

            }
            if ($dir == "E") {
                return \Arena\RobotOrder::AHEAD;

            }

        }
    }

    public function makeTurn()
    {
        $dir = $this->position->getDirection();
        if ($dir == "N") {
            return \Arena\RobotOrder::TURN_LEFT;
        }
        if ($dir == "S") {
            if ($_SESSION["last"] == "fire") {
                if ($_SESSION["sens"] == "left" || !(isset($_SESSION["sens"]))) {
                    return \Arena\RobotOrder::TURN_RIGHT;
                } else {
                    return \Arena\RobotOrder::TURN_LEFT;
                }
            }
            return \Arena\RobotOrder::FIRE;

        }
        if ($dir == "E" || $dir == "W") {
            if ($_SESSION["last"] == "right" || $_SESSION["last"] == "left") {
                return \Arena\RobotOrder::AHEAD;
            }
            if ($_SESSION["last"] == "ahead") {
                if ($_SESSION["sens"] == "left" || !(isset($_SESSION["sens"]))) {
                    return \Arena\RobotOrder::TURN_LEFT;

                }
                if ($_SESSION["sens"] == "right") {
                    return \Arena\RobotOrder::TURN_RIGHT;
                }
            }
        }

    }

    public function thereISAWall()
    {
        $wall = [];
        $surroundings = $this->surroundings;
        $y = +2;
        foreach ($surroundings as $line) {
            $x = -2;
            foreach ($line as $case) {

                if ($y == 1 && $x == 0) {
                    if ($case == "x") {
                        array_push($wall, "mur en haut");
                    }
                }
                if ($y == -1 && $x == 0) {
                    if ($case == "x") {
                        array_push($wall, "mur en bas");
                    }
                }
                if ($y == 0 && $x == 1) {
                    if ($case == "x") {
                        array_push($wall, "mur a droite");
                    }
                }
                if ($y == 0 && $x == -1) {
                    if ($case == "x") {
                        array_push($wall, "mur a gauche");
                    }
                }
                $x = $x + 1;
            }
            $y = $y - 1;
        }
        if ($wall == []) {
           
            return false;
        } else {
            return $wall;
        }
    }

    private function canIMove()
    {
        $d = $this->position->getDirection();
        $surroundings = $this->surroundings;
        $detected = false;
        if ($d == "N") {
            return $this->boucleSurroundings("y-1");
        }
        if ($d == "S") {
            return $this->boucleSurroundings("y1");
        }
        if ($d == "E") {
            return $this->boucleSurroundings("x1");
        }
        if ($d == "W") {
            return $this->boucleSurroundings("x-1");
        }
    }

    private function boucleSurroundings($pos)
    {
        $surroundings = $this->surroundings;
        $test = false;
        $y = +2;
        foreach ($surroundings as $line) {
            $x = -2;
            foreach ($line as $case) {
                if ($case == "B" || $case == "A") {
                    
                 
                    
                    if ($pos = "y1") {
                        if ($y == "1") {
                            return "sce";
                        }
                    }
                    if ($pos = "y-1") {
                        if ($y == -1) {
                            return "scvez";
                        }
                    }
                    if ($pos = "x1") {
                        if ($x == "1") {
                            return "ed";
                        }
                    }
                    if ($pos = "x-1") {
                        if ($x == -1) {
                            return "scz";
                        }
                    }

                }
                $x = $x + 1;
            }
            $y = $y - 1;
        }
        return false;

    }

    public function detectOtherRobot()
    {
        $surroundings = $this->surroundings;
        $detected = false;
        $y = +2;
        foreach ($surroundings as $line) {
            $x = -2;
            foreach ($line as $case) {
                if ($case == "B" || $case == "A") {
                    if ($x == 1 || $x == -1 || $y = 1) {
                        return $x;
                    }
                }
                $x = $x + 1;
            }
            $y = $y - 1;
        }
        return $detected;
    }
    public function postHit()
    {

    }

}

