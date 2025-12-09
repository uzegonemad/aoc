<?php

$debug = false;

function setDebug(bool $value): void {
    global $debug;
    $debug = $value;
}

function dd(...$args): void {
    global $debug;
    if(!$debug) {
        return;
    }

    foreach($args as $arg) {
        var_dump($arg);
    }
    die();
}

function info(...$args): void {
    global $debug;
    if(!$debug) {
        return;
    }

    foreach($args as $arg) {
        var_dump($arg);
    }
}

function load(string $filename): string {
    global $debug;
    if($filename === 'sample.txt') {
        setDebug(true);
    }

    return trim(file_get_contents($filename));
}

function loadLines(string $filename): array {
    $input = load($filename);
    return explode("\n", $input);
}
