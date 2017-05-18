<?php

// Build the Board

class Board {
    /*
    //  _0_1_2_3_4_5_6_7_8_9_
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
    private $bombs = array(array());
    private $lost = false;
    
    function __construct() {
        for ($i = 0; $i < 10; $i++) {
            $this->bombs[mt_rand(0,9)][mt_rand(0,9)] = true;
        }
        var_dump($this->bombs);
    }
    
    public function draw() {
        for ($i = 0; $i < 10; $i++) {
            echo("_$i");
        }
        echo("_\n");
        
        
    }
    
    public function checkCell($x, $y) {
        if ($this->bombs[$x][$y]) {
            echo("($x, $y) was a bomb.\n");
            $this->lost = true;
        }
    }
    
    public function checkStatus() {
        if ($this->lost) {
            echo("BOOM\nGame Over\n");
            die;
        }
    }
}
?>
