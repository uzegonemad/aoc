<?php

require_once '../util.php';

// $input = file_get_contents('sample.txt');
$input = file_get_contents('input.txt');

$invalidAgg = 0;

$lines = $input
    |> trim(...)
    |> (fn(string $str) => explode(",", $str))
;

foreach($lines as $line) {
    $parts = explode('-', $line);
    $start = (int)$parts[0];
    $end = (int)$parts[1];

    for($i = $start; $i <= $end; $i++) {
        $iStr = (string)$i;

        // odd length numbers cant be invalid becuase they cant be made of two equal halves
        if(strlen($iStr) % 2 !== 0) {
            continue;
        }

        $j = substr($iStr, 0, strlen($iStr)/2);

        if(stristr($iStr, $j.$j)) {
            $invalidAgg += $i;
        }
    }
}

echo $invalidAgg."\n";
