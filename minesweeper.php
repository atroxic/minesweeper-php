<?php

require_once "Board.class.php";
//require_once "Grid.class.php";

$board = new Board();

$board->draw();
while (true) {
    for ($x = 0; $x < 10; $x++) {
        for ($y = 0; $y < 10; $y++) {
            $board->checkCell($x, $y);
            $board->checkStatus();
        }
    }
}

?>
