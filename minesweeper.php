<?php

require_once "Minesweeper.class.php";
//require_once "Grid.class.php";

$board = new Minesweeper();

$board->draw();
while (true) {
    do {
        $x = readline("Choose a X Coordinate: ");
    } while (!is_int(intval($x)));
    echo("\n");
    do {
        $y = readline("Choose a Y Coordinate: ");
    } while (!is_int(intval($y)));
    echo("\n");
    $board->checkCell($x, $y);
    echo("\n");
}

?>
