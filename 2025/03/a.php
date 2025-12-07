<?php

require_once '../util.php';

// $input = file_get_contents('sample.txt');
$input = file_get_contents('input.txt');

$lines = $input
    |> trim(...)
    |> (fn(string $str) => explode("\n", $str))
;

$total = 0;

foreach($lines as $line) {
    $highestNum = null;
    $highestNumIndex = null;
    $secondHighestNum = null;

    // get highest
    $highestArr = str_split($line);
    array_pop($highestArr);
    foreach($highestArr as $i => $char) {
        $num = (int)$char;
        if($highestNum === null || $num > $highestNum) {
            $highestNum = $num;
            $highestNumIndex = $i;
        }
    }

    $secondHighestArr = array_slice(str_split($line), $highestNumIndex + 1);

    // get second highest (must be after highest)
    foreach($secondHighestArr as $i => $char) {
        $num = (int)$char;
        if($secondHighestNum === null || $num > $secondHighestNum) {
            $secondHighestNum = $num;
        }
    }

    $joltage = (int) $highestNum.$secondHighestNum;
    $total += $joltage;
}

echo $total."\n";
