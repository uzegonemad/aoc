<?php

require_once '../util.php';

// $input = load('sample.txt');
$input = load('input.txt');

$lines = $input
    |> (fn(string $str) => explode("\n", $str))
;

$numBatteries = 12;
$total = 0;

foreach($lines as $line) {
    $batteries = str_split($line);

    $lineTotal = '';
    $nextIndex = 0;
    for($i = 0; $i < $numBatteries; $i++) {
        $max = 0;

        // calculate maximum we can traverse on this iteration
        $jMax = count($batteries) - ($numBatteries - $i) + 1;

        info('jMax: '.$jMax);

        for($j = $nextIndex; $j < $jMax; $j++) {
            $value = $batteries[$j];
            if($value > $max) {
                $max = $value;
                $nextIndex = $j + 1;
            }
        }

        $lineTotal .= (string) $max;
    }

    $total += (int) $lineTotal;
}

echo $total."\n";
