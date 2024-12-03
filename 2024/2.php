<?php

require_once dirname(__FILE__) . '/../functions.php';

$input = get_input(dirname(__FILE__) . '/2.txt');

$reports = array_map(fn($item) => explode(" ", $item), $input);

$safeReports = 0;
$dampenerSafeReports = 0;
foreach ($reports as $report) {
    if (isReportSafe($report)) {
        $safeReports++;
        $dampenerSafeReports++;
    } else {
        if (isReportSafeAfterApplyingDampenerModule($report)) {
            $dampenerSafeReports++;
        }
    }
}

function isReportSafeAfterApplyingDampenerModule(array $report): bool
{
    for ($i = 0; $i < count($report); $i++) {
        $reportWithoutBadLevel = array_merge(array_slice($report, 0, $i), array_slice($report, $i + 1));
        if (isReportSafe($reportWithoutBadLevel)) {
            return true;
        }
    }
    return false;
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
echo $dampenerSafeReports . "\n";