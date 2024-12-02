<?php

require_once dirname(__FILE__) . '/../functions.php';

$input = get_input(dirname(__FILE__) . '/2.txt');

$reports = array_map(fn($item) => explode(" ", $item), $input);

$safeReports = 0;
foreach ($reports as $report) {
    $safeReports += isReportSafe($report) ? 1 : 0;
}

function isReportSafe(array $report): bool
{
    for ($i = 0; $i < count($report) - 1; $i++) {
        $previousLevel = $report[$i - 1] ?? null;
        $currentLevel = $report[$i];
        $nextLevel = $report[$i + 1];

        $wasIncreasing = $previousLevel < $currentLevel;
        $isIncreasing = $currentLevel < $nextLevel;

        // Check if the current number is not the same as the next number
        if ($currentLevel === $nextLevel) {
            return false;
        }

        // Check if the difference between the current and next level is not greater than 3
        $difference = $currentLevel - $nextLevel;
        if (abs($difference) > 3) {
            return false;
        }

        // Check if the direction of the slope has changed
        if ($previousLevel && $isIncreasing !== $wasIncreasing) {
            return false;
        }
    }
    return true;
}

echo $safeReports . "\n";
