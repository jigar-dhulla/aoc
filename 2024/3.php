<?php

require_once dirname(__FILE__) . '/../functions.php';

$instructions = get_input(dirname(__FILE__) . '/3.txt');

$total = 0;
foreach ($instructions as $instruction) {
    preg_match_all('/mul\((\d+),(\d+)\)/', $instruction, $matches);
    foreach ($matches[0] as $k => $match) {
        $total += $matches[1][$k] * $matches[2][$k];
    }
}

echo $total . "\n";
