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

        // we can start it at half the length because it would be impossible for a longer repeated sequence to exist
        $j = substr($iStr, 0, floor(strlen($iStr/2)));

        while(strlen($j) > 1) {
            $j = substr($j, 0, -1);

            // ensure this candidate can actually fit an even number of times in the string
            if(strlen($iStr) % strlen($j) !== 0) {
                continue;
            }

            $toPad = strlen($iStr) / strlen($j);

            $check = str_repeat($j, $toPad);
            if($check === $iStr) {
                $invalidAgg += $i;
                break;
            }
        }
    }
}

echo $invalidAgg."\n";
