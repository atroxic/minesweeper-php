<?php

// Build the Board

class Minesweeper {

    private $bombs = array(array());
    private $cleared = array(array());
    private $lost = false;
    
    function __construct() {
        for ($i = 0; $i < 10; $i++) {
            $this->bombs[mt_rand(0,9)][mt_rand(0,9)] = true;
        }
        
        // Fill $cleared array with falses.
        for ($y = 0; $y < 10; $y++) {
            for ($x = 0; $x < 10; $x++) {
                $this->cleared[$x][$y] = false;
            }
        }
    }
    
    public function draw() {
        /*
        // _|0_1_2_3_4_5_6_7_8_9|
        // 0|_|_|_|_|_|_|_|_|_|_|
        // 1|_|_|_|_|_|_|_|_|_|_|
        // 2|_|_|_|_|_|_|_|_|_|_|
        // 3|_|_|_|_|_|_|_|_|_|_|
        // 4|_|_|_|_|_|_|_|_|_|_|
        // 5|_|_|_|_|_|_|_|_|_|_|
        // 6|_|_|_|_|_|_|_|_|_|_|
        // 7|_|_|_|_|_|_|_|_|_|_|
        // 8|_|_|_|_|_|_|_|_|_|_|
        // 9|_|_|_|_|_|_|_|_|_|_|
        */        
        //Header
        echo("_|0");
        for ($i = 1; $i < 10; $i++) {
            echo("_$i");
        }
        echo("|\n");
        
        // Rows
        for ($i = 0; $i < 10; $i++) {
            $row = "$i|";
            for ($j = 0; $j < 10; $j++) {
                if ($this->isCleared($j, $i)) {
                    if ($this->isBomb($j, $i)) {
                        $row .= "X|";
                    } else {
                        $row .= $this->checkSurrounding($j, $i) . "|";
                    }
                } else {
                    $row .= "_|";
                }
            }
            echo($row . "\n");
        }
        
    }
    
    private function checkSurrounding($x, $y) {
        // Returns count of surround bombs
        // Grid: [[($x-1, $y-1), ($x, $y-1), ($x+1, $y-1)],
        //        [($x-1, $y),   ($x, $y),   ($x+1, $y)],
        //        [($x-1, $y+1), ($x, $y+1), ($x+1, $y+1)]]
        
        $count = 0;
        for ($i = -1; $i < 2; $i++) {
            for ($j = -1; $j < 2; $j++) {
                if ($j == 0 && $i == 0) {
                    continue;
                } elseif ($this->isBomb($x + $j, $y + $i)) {
                    $count++;
                } elseif ($y + $i >= 0 && $y + $i < 10 && $x + $j >= 0 && $x + $j < 10 && $count == 0 && !$this->cleared[$x + $j][$y + $i]) {
                    $this->cleared[$x + $j][$y + $i] = true;
                    $this->checkSurrounding($x + $j, $y + $i);
                }
            }
        }
        return $count;
    }
    
    private function isBomb($x, $y) {
        if ($x >= 0 && $y >= 0 && $this->bombs[$x][$y]) {
            return true;
        }
        return false;
    }
    
    private function isCleared($x, $y) {
        if ($x >= 0 && $y >= 0 && $this->cleared[$x][$y]) {
            return true;
        }
        return false;
    }    
    
    public function checkCell($x, $y) {
        if ($x > 9 || $x < 0 || $y > 9 || $y < 0) {
            echo("Invalid Entry.\n");
        } elseif ($this->isBomb($x, $y)) {
            $this->lost = true;
            $this->cleared[$x][$y] = true;
        } elseif ($this->isCleared($x, $y)) {
            echo("That cell has already been played.\n");
        } else {
            $this->cleared[$x][$y] = true;
        }
        $this->checkStatus();
        echo("\n");
        $this->draw();
    }
    
    private function checkStatus() {
        if ($this->lost) {
            echo("BOOM\nGame Over\n");
            $this->draw();
            die;
        } elseif ($this->countBoard() >= 90) {
            echo("Well Done. You Win!\n");
            die;
        }
    }
    
    private function countBoard() {
        $count = 0;
        foreach($this->cleared as $row) {
            foreach($row as $cell) {
                if ($cell) {
                    $count++;
                }
            }
        }
        return $count;
    }
}
?>
