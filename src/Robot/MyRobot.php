<?php

namespace Robot;

class MyRobot implements \Arena\Robot
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
        var_dump($_SESSION);
        var_dump($this->position);
        $this->ifInitialCase();
        if ($this->detectOtherRobot()) {
            $Enemy = $this->detectOtherRobot();
            var_dump($Enemy);
            $section = $this->WhichSection($Enemy);
            var_dump($section);
            $this->makeChoice($section, $Enemy);
            if ($this->makeChoice($section, $Enemy) == "turn_left") {
                $_SESSION["last"] = "left";

                return \Arena\RobotOrder::TURN_LEFT;

            }
            if ($this->makeChoice($section, $Enemy) == "turn_right") {
                $_SESSION["last"] = "right";

                return \Arena\RobotOrder::TURN_RIGHT;

            }
            if ($this->makeChoice($section, $Enemy) == "fire") {
                $_SESSION["last"] = "fire";

                return \Arena\RobotOrder::FIRE;

            }
            if ($this->makeChoice($section, $Enemy) == "ahead") {
                $_SESSION["last"] = "ahead";

                return \Arena\RobotOrder::AHEAD;

            }
        } else {


            if (isset($_SESSION["position"]) && $_SESSION["position"]== "reverse") {
                if ($this->thereISAWall() == ["mur en haut", "mur a droite"]) {
                    if ($this->position->getDirection() == "N") {
                        $_SESSION["last"] = "left";
                        return \Arena\RobotOrder::TURN_LEFT;
                        
                    }
                    if ($this->position->getDirection() == "W") {
                        $_SESSION["last"] = "ahead";
                        return \Arena\RobotOrder::AHEAD;
                    }
                }
                $_SESSION["last"] = "ahead";
                return \Arena\RobotOrder::AHEAD;

            }



            if ($this->thereISAWall()) {
                $wall = $this->thereISAWall();
                var_dump($this->isBlocked($wall));
                if ($this->isBlocked($wall) == "turn_left") {
                    $_SESSION["last"] = "left";

                    return \Arena\RobotOrder::TURN_LEFT;

                }
                if ($this->isBlocked($wall) == "turn_right") {
                    $_SESSION["last"] = "right";
                    

                    return \Arena\RobotOrder::TURN_RIGHT;
                }
                if ($this->isBlocked($wall) == "fire") {
                    $_SESSION["last"] = "fire";

                    return \Arena\RobotOrder::FIRE;

                }
                if ($this->isBlocked($wall) == "ahead") {
                    $_SESSION["last"] = "ahead";
                    return \Arena\RobotOrder::AHEAD;
                }
            }

        }
        $d = $this->position->getDirection();
        $y = $this->position->getY();
if(isset($_SESSION["position"])){
        if ($y % 2 == 1) {
            
                

            
            if ($d == "E") {
               

                return \Arena\RobotOrder::TURN_RIGHT;

            }
            if ($d == "S") {
                die('c');

                return \Arena\RobotOrder::TURN_RIGHT;

            }
            if ($d == "N") {

                return \Arena\RobotOrder::TURN_LEFT;
            }
        } else {

            if ($d == "W") {
               

                return \Arena\RobotOrder::TURN_RIGHT;

            }
            if ($d == "S") {

                return \Arena\RobotOrder::TURN_LEFT;

            }
            if ($d == "N") {

                return \Arena\RobotOrder::TURN_RIGHT;
            }
        }
    }
    var_dump("fin de requestMove");
        $_SESSION["last"] = "ahead";
        return \Arena\RobotOrder::AHEAD;
    }

    private function makeChoice($section, $enemyPos)
    {
        $d = $this->position->getDirection();
        if ($section == "N") {
            switch ($d) {
                case 'N':
                    return \Arena\RobotOrder::FIRE;
                    break;
                case 'S':
                
                    return \Arena\RobotOrder::TURN_LEFT;
                    break;
                case 'W':
                    return \Arena\RobotOrder::TURN_RIGHT;
                    break;
                case 'E':
                    return \Arena\RobotOrder::TURN_LEFT;
                    break;

            }
        }
        if ($section == "E") {
            switch ($d) {
                case 'E':
                    return \Arena\RobotOrder::FIRE;
                    break;
                case 'S':
                    return \Arena\RobotOrder::TURN_LEFT;
                    break;
                case 'W':
                    return \Arena\RobotOrder::TURN_LEFT;
                    break;
                case 'N':
                    return \Arena\RobotOrder::TURN_RIGHT;
                    break;

            }
        }
        if ($section == "S") {
            switch ($d) {
                case 'S':
                    return \Arena\RobotOrder::FIRE;
                    break;
                case 'W':
                    return \Arena\RobotOrder::TURN_LEFT;
                    break;
                case 'W':
                    return \Arena\RobotOrder::TURN_LEFT;
                    break;
                case 'E':
                    return \Arena\RobotOrder::TURN_RIGHT;
                    break;
            }
        }
        if ($section == "W") {
            switch ($d) {
                case 'W':
                    return \Arena\RobotOrder::FIRE;
                    break;
                case 'N':
                    return \Arena\RobotOrder::TURN_LEFT;
                    break;
                case 'E':
                    return \Arena\RobotOrder::TURN_LEFT;
                    break;
                case 'S':
                    return \Arena\RobotOrder::TURN_RIGHT;
                    break;

            }
        }
        if ($section == "NE") {
            $_SESSION["section"] = "NE";
            if ($d == "W") {
                return \Arena\RobotOrder::TURN_RIGHT;
            }
            if ($d == "S") {
                return \Arena\RobotOrder::TURN_LEFT;
            }
            if ($d == "E") {
                return \Arena\RobotOrder::AHEAD;

            }
            if ($d == "N") {
                return \Arena\RobotOrder::AHEAD;

            }

        }

        if ($section == "NW") {
            $_SESSION["section"] = "NW";
            if ($d == "W") {
                return \Arena\RobotOrder::AHEAD;
            }
            if ($d == "S") {
                return \Arena\RobotOrder::TURN_RIGHT;
            }
            if ($d == "E") {
                return \Arena\RobotOrder::TURN_LEFT;

            }
            if ($d == "N") {
                return \Arena\RobotOrder::AHEAD;

            }

        }
        if ($section == "SE") {
            $_SESSION["section"] = "SE";
            if ($d == "W") {
                return \Arena\RobotOrder::TURN_LEFT;
            }
            if ($d == "S") {
                return \Arena\RobotOrder::AHEAD;
            }
            if ($d == "E") {
                return \Arena\RobotOrder::AHEAD;

            }
            if ($d == "N") {
                return \Arena\RobotOrder::TURN_RIGHT;

            }
        }
        if ($section == "SW") {
            $_SESSION["section"] = "SW";
            if ($d == "W") {
                return \Arena\RobotOrder::AHEAD;
            }
            if ($d == "S") {
                return \Arena\RobotOrder::AHEAD;
            }
            if ($d == "E") {
                return \Arena\RobotOrder::TURN_RIGHT;

            }
            if ($d == "N") {
                return \Arena\RobotOrder::TURN_LEFT;

            }
        }
    }

    private function ifInitialCase()
    {
        $x = $this->position->getX();
        $y = $this->position->getY();
        if ($x == 2 && $y == 2) {
            $_SESSION["Position"] = "atteint";
        }
    }

    private function isBlocked($wall)
    {

        $x = $this->position->getX();
        $y = $this->position->getY();
        $dir = $this->position->getDirection();
        if (isset($_SESSION["Position"])) {
            var_dump($wall);
            if (sizeof($wall) == "1") {
                $wall = $wall[0];
                if ($wall == "mur en haut") {
                    return \Arena\RobotOrder::AHEAD;

                }
                if ($wall == "mur en bas") {
                    return \Arena\RobotOrder::AHEAD;

                }
                if ($wall == "mur a droite") {
                    var_dump($dir);

                    if ($dir == "E") {
                        return \Arena\RobotOrder::TURN_RIGHT;
                    }
                    if ($dir == "W") {
                        return \Arena\RobotOrder::AHEAD;

                    }
                    if ($dir == "S") {
                        if ($_SESSION["last"] == "ahead") {
                            return \Arena\RobotOrder::TURN_RIGHT;

                        }
                        return \Arena\RobotOrder::AHEAD;
                    }

                }

                if ($wall == "mur a gauche") {
                    if ($dir == "S") {
                        if ($_SESSION["last"] == "ahead") {
                            return \Arena\RobotOrder::TURN_LEFT;

                        }
                        return \Arena\RobotOrder::AHEAD;
                    }
                    if ($dir == "E") {
                        return \Arena\RobotOrder::AHEAD;

                    }

                    if ($dir == "W") {
                        return \Arena\RobotOrder::TURN_LEFT;
                    }

                }
            }

            if (sizeof($wall) == "2") {
                if ($wall == ["mur en haut", "mur a gauche"]) {
                    var_dump($dir);
                    if ($dir == "W") {
                        return \Arena\RobotOrder::TURN_LEFT;
                    }
                    if ($dir == "S") {
                        return \Arena\RobotOrder::TURN_LEFT;
                    }
                    if ($dir == "E") {
                        return \Arena\RobotOrder::AHEAD;
                    }
                }
                if ($wall == ["mur en haut", "mur a droite"]) {
                    var_dump($dir);
                    if ($dir == "S") {
                        return \Arena\RobotOrder::AHEAD;
                    }
                    if ($dir == "N") {
                        return \Arena\RobotOrder::TURN_RIGHT;
                    }
                    if ($dir == "E") {
                        return \Arena\RobotOrder::TURN_RIGHT;
                    }
                }

                if ($wall == ["mur en bas", "mur a droite"]) {
                    if ($dir == "N") {
                        $_SESSION["Position"] = "reverse";
                        return \Arena\RobotOrder::TURN_RIGHT;
                    }
                    if ($dir == "E") {
                        return \Arena\RobotOrder::TURN_LEFT;
                    }
                }

                if ($wall == ["mur en bas", "mur a gauche"]) {
                    var_dump($dir);
                    if ($dir == "S") {
                        return \Arena\RobotOrder::TURN_RIGHT;
                    }
                    if ($dir == "E") {
                        return \Arena\RobotOrder::AHEAD;
                    }
                }

            }
        } else {
            if (sizeof($wall) == "1") {
                if ($wall[0] == "mur en haut") {
                    var_dump($dir);
                    if ($dir == "N") {
                        return \Arena\RobotOrder::TURN_LEFT;
                    }
                    if ($dir == "W") {
                        return \Arena\RobotOrder::AHEAD;
                    }
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
                    var_dump($case);
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
            var_dump("coucou");
            return false;
        } else {
            var_dump("svk");
            return $wall;
        }
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
                    if ($x != 0 || $y != 0) {
                        var_dump($case);
                        $detected = (["x" => $x, "y" => $y]);
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

    /**
     *
     * Fonction pour determiner à partir de la position de l'autre robot la section dans laquelle il est et qui prend en entrée la position par rapport
     * a ce robot du robot ennemi .
     */

    private function WhichSection(array $position)
    {
        var_dump($position);
        if ($position["x"] > 0 && $position["y"] > 0) {
            return "NE";
        }
        if ($position["x"] < 0 && $position["y"] > 0) {
            return "NW";
        }
        if ($position["x"] > 0 && $position["y"] < 0) {
            return "SE";
        }
        if ($position["x"] < 0 && $position["y"] < 0) {
            return "SW";
        }
        if ($position["x"] == 0 || $position["y"] == 0) {
            if ($position["x"] == 0) {
                if ($position["y"] > 0) {
                    return "N";
                }
                if ($position["y"] < 0) {
                    return "S";
                }
            }
            if ($position["y"] == 0) {
                if ($position["x"] > 0) {
                    return "E";
                }
                if ($position["x"] < 0) {
                    return "W";
                }
            }

        }
    }
}
