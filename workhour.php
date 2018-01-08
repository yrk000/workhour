<?php

// 週末
$weekend = [0, 6];
// 祝日
$publicHoliday = [
	1 => [1, 8],
	2 => [11],
	3 => [21],
	4 => [29],
	5 => [3,4,5],
	6 => [],
	7 => [16],
	8 => [11],
	9 => [17,23],
	10 => [8],
	11 => [3,23],
	12 => [24],
];

$year = date('Y');
$month = date('n');

// 当月の日数
$days = date('d', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));

$workDays = 0;
for ($day = 1; $day <= $days; $day++) {
	$timestamp = mktime(0, 0, 0, $month, $day, $year);
	// 土日は省く
	$week = date('w', $timestamp);
	if (in_array($week, $weekend)) {
		continue;
	}
	// 祝日は省く
	if (in_array($day, $publicHoliday[$month])) {
		continue;
	}
	// 振替休日(月曜日かつ前日が祝日だったら)
	if ($week === 1 && in_array($day - 1, $publicHoliday[$month])) {
		continue;
	}
	$workDays++;
}

$workHours = 8;
$monthWorkHours = $workDays * $workHours;
echo "今月は定時退社でこんなに働くんだよ！" . $monthWorkHours . "時間！！";

exit;
