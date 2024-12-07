<?php

require_once dirname(__FILE__) . '/../functions.php';

$instructions = get_input(dirname(__FILE__) . '/3.txt');
$instruction = implode("", $instructions);
$part2 = 0;
$part1 = 0;

// $instruction = 'xmul(2,4)&mul[3,7]!^don\'t()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))';

// Part 1
$part1 = instruction_total($instruction);

// Part 2
$part2 = 0;
$enabled = true;
$pos = 0;
while ($pos < strlen($instruction)) {
    $doPos = false;
    $tempPos = strpos($instruction, 'do()', $pos);
    if ($tempPos !== false) {
        if ($tempPos === 0 || $instruction[$tempPos - 1] !== 'n') {
            $doPos = $tempPos;
        }
    }
    
    $dontPos = strpos($instruction, 'don\'t()', $pos);
    
    if ($doPos !== false && $dontPos !== false) {
        $nextPos = min($doPos, $dontPos);
        $isDoInstruction = ($nextPos === $doPos);
    } else if ($doPos !== false) {
        $nextPos = $doPos;
        $isDoInstruction = true;
    } else if ($dontPos !== false) {
        $nextPos = $dontPos;
        $isDoInstruction = false;
    } else {
        if ($enabled) {
            $part2 += instruction_total(substr($instruction, $pos));
        }
        break;
    }
    
    if ($enabled) {
        $part2 += instruction_total(substr($instruction, $pos, $nextPos - $pos));
    }
    
    $enabled = $isDoInstruction;
    $pos = $nextPos + ($isDoInstruction ? 4 : 7);
}

function instruction_total($instruction) {
    $total = 0;
    preg_match_all('/mul\((\d+),(\d+)\)/', $instruction, $matches);
    foreach ($matches[0] as $k => $match) {
        $total += $matches[1][$k] * $matches[2][$k];
    }
    return $total;
}

echo $part1 . "\n";
echo $part2 . "\n";