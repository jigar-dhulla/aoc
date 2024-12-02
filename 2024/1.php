<?php

require_once dirname(__FILE__) . '/../functions.php';

$input = get_input(dirname(__FILE__) . '/1.txt');

$array = array_map(fn($item) => explode("   ", $item), $input);

$left = array_map(fn($item) => (int)$item[0], $array);
$right = array_map(fn($item) => (int)$item[1], $array);

sort($left);
sort($right);

$distance = 0;
for ($i = 0; $i < count($left); $i++) {
    $distance += abs($left[$i] - $right[$i]);
}

echo $distance . "\n";

$rightItemCount = [];
foreach ($right as $rightItem) {
    $rightItemCount[$rightItem] ??= 0;
    $rightItemCount[$rightItem]++;
}

$similarilityScore = 0;
foreach ($left as $leftItem) {
    $similarilityScore += $leftItem * ($rightItemCount[$leftItem] ?? 0);
}

echo $similarilityScore . "\n";
