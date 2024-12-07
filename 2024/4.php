<?php

require_once dirname(__FILE__) . '/../functions.php';

$rows = get_input(dirname(__FILE__) . '/4.txt');

// $rows = [
//     'MMMSXXMASM',
//     'MSAMXMSMSA',
//     'AMXSXMAAMM',
//     'MSAMASMSMX',
//     'XMASAMXAMM',
//     'XXAMMXXAMA',
//     'SMSMSASXSS',
//     'SAXAMASAAA',
//     'MAMMMXMMMM',
//     'MXMXAXMASX',
// ];

$total = 0;
foreach ($rows as $y => $row) {
    foreach (str_split($row) as $x => $char) {
        $total += isXMAS($x, $y, $rows);
    }
}

echo $total . "\n";

function isXMAS($x, $y, $rows): int {
    $directions = [
        'right' => [0, 1],
        'left' => [0, -1],
        'down' => [1, 0],
        'up' => [-1, 0],
        'down-right' => [1, 1],
        'down-left' => [1, -1],
        'up-right' => [-1, 1],
        'up-left' => [-1, -1]
    ];

    $count = 0;
    foreach ($directions as $direction => [$dy, $dx]) {
        if (!isOutsideOfMatrix($y, $x, $dy, $dx) 
            && $rows[$y][$x] === 'X' 
            && ($rows[$y + $dy][$x + $dx] ?? '') === 'M' 
            && ($rows[$y + 2*$dy][$x + 2*$dx] ?? '') === 'A' 
            && ($rows[$y + 3*$dy][$x + 3*$dx] ?? '') === 'S') {
            $count += 1;
        }
    }

    return $count;
}

function isOutsideOfMatrix($y, $x, $dy, $dx): bool {
    return $y + $dy < 0 || $x + $dx < 0 || $y + 2*$dy < 0 || $x + 2*$dx < 0 || $y + 3*$dy < 0 || $x + 3*$dx < 0;
}
