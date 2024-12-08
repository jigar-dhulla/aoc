<?php

require_once dirname(__FILE__) . '/../functions.php';

$rows = get_input(dirname(__FILE__) . '/5.txt');
$empty_row_index = array_search('', $rows);
$orders = array_slice($rows, 0, $empty_row_index);
$updates = array_slice($rows, $empty_row_index + 1);

// $orders = [
//     '47|53',
//     '97|13',
//     '97|61',
//     '97|47',
//     '75|29',
//     '61|13',
//     '75|53',
//     '29|13',
//     '97|29',
//     '53|29',
//     '61|53',
//     '97|53',
//     '61|29',
//     '47|13',
//     '75|47',
//     '97|75',
//     '47|61',
//     '75|61',
//     '47|29',
//     '75|13',
//     '53|13',
//     '75|47',
//     '61|53',
//     '29|13',
//     '97|61',
//     '53|29',
// ];

// $updates = [
//     '75,47,61,53,29',
//     '97,61,53,29,13',
//     '75,29,13',
//     '75,97,47,61,53',
//     '61,13,29',
//     '97,13,75,29,47',
// ];

$part1 = 0;
foreach ($updates as $update) {
    $update = explode(',', $update);
    if (isValidUpdate($update, $orders)) {
        $part1 += getMiddlePage($update);
    }
}

function isValidUpdate(array $update, array $orders): bool
{
    $isValid = true;
    foreach ($orders as $order) {
        [$x, $y] = explode('|', $order);
        if (in_array($x, $update) && in_array($y, $update)) {
            $xPos = array_search($x, $update);
            $yPos = array_search($y, $update);
            if ($xPos > $yPos) {
                $isValid = false;
            }
        }

        if ($isValid === false) {
            return false;
        }
    }

    return $isValid;
}

function getMiddlePage(array $update): int
{
    return $update[ceil(count($update) / 2) - 1];
}

echo $part1 . "\n";
