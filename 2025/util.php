<?php

function dd(...$args): void {
    foreach($args as $arg) {
        var_dump($arg);
    }
    die();
}
