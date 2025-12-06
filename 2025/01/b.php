<?php

//$input = file_get_contents('sample.txt');
$input = file_get_contents('input.txt');

$dialPos = 50;
$zeroCount = 0;

$lines = $input
    |> trim(...)
    |> (fn(string $str) => str_replace('L', '-', $str))
    |> (fn(string $str) => str_replace('R', '', $str))
    |> (fn(string $str) => explode("\n", $str))
;

foreach($lines as $line) {
    $remaining = $line;
    while($remaining != 0) {
        // going left
        if($remaining < 0) {
            $num = -1;
            $remaining++;
        // going right
        } else {
            $num = 1;
            $remaining--;
        }
        
        $dialPos += $num;

        // right overflow
        while($dialPos > 99) {
            $dialPos -= 100;
        }
    
        // left overflow
        while($dialPos < 0) {
            $dialPos += 100;
        }
    
        if($dialPos == 0) {
            $zeroCount++;
        }
    }
}

echo $zeroCount."\n";
