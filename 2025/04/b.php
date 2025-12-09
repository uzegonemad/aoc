<?php

require_once '../util.php';

$lines = loadLines('input.txt');

function isOccupied($grid, $x, $y) {
    // todo: check why isset() from line 20 isn't working

    if($x < 0 || $y < 0) {
        info("Negative bounds check at (x $x, y $y)");
        return false;
    }

    if($y > count($grid) || $x > strlen($grid[0])) {
        info("Exceeded bounds check at (x $x, y $y)");
        return false;
    }

    if(!isset($grid[$y]) || !isset($grid[$y][$x])) {
        info("Out of bounds check at (x $x, y $y)");
        return false;
    }

    info("Checking occupancy at (x $x, y $y): ".$grid[$y][$x]);

    return $grid[$y][$x] === '@';
}

function countAdjacentOccupied($grid, $x, $y) {
    $count = 0;

    // start one row up, end one row below
    for($ay = -1; $ay <= 1; $ay++) {
        // start one column left, end one column right
        for($ax = -1; $ax <= 1; $ax++) {
            // skip self
            if($ax === 0 && $ay === 0) {
                info("Skipping self at (x $x, y $y): ".$grid[$y][$x]);
                continue;
            }

            // todo: optimize by continuing if out of bounds
            $tX = $x + $ax;
            $tY = $y + $ay;
            info($tX.','.$tY);
            if(!isset($grid[$tY]) || !isset($grid[$tY][$tX])) {
                info("Out of bounds check at (x $tX, y $tY)");
                info("X exists: ".(isset($grid[$tY][$tX]) ? 'yes' : 'no'));
                info("Y exists: ".(isset($grid[$tY]) ? 'yes' : 'no'));
                continue;
            }

            info("GRID", $grid[$tY]);

            if(isOccupied($grid, $x + $ax, $y + $ay)) {
                $count++;
            }
        }
    }

    return $count;
}

$outMap = $lines;
$usableRolls = 0;

$foundRollsToRemove = true;
do {
    $foundThisTime = false;

    foreach($lines as $y => $line) {
        foreach(str_split($line) as $x => $char) {
            if($char !== '@') {
                continue;
            }

            info("Checking seat at (x $x, y $y): ".$lines[$y][$x]);

            $adjacent = countAdjacentOccupied($lines, $x, $y);

            if($adjacent < 4) {
                $usableRolls++;
                $foundThisTime = true;
                $outMap[$y][$x] = 'x';
            }
        }
    }

    $foundRollsToRemove = $foundThisTime;

    $lines = $outMap;
} while($foundRollsToRemove);

info(implode("\n", $outMap)."\n");

echo $usableRolls."\n";
