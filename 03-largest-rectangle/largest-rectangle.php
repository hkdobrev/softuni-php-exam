<?php

$json = $_GET['jsonTable'];

$table = json_decode($json);
$rowsCount = count($table);

// The input is always a rectangle
// so we know each row has the same number of items
$colsCount = count($table[0]);

define('X', 0);
define('Y', 1);

$largestRectangleA = [0, 0];
$largestRectangleB = [0, 0];
$largestRectangleSize = 1;
$largestRectangleString = $table[$rectangleA[$i], $rectangleA[Y]];

for ($i = 0; $i < $rowsCount - 1; $i++) {
	for ($j = 0; $j < $colsCount - 1; $j++) {
		$rectangleA = [$i, $j];
		$rectangleB = [$i, $j];
		$rectangleString = $table[$rectangleA[$i], $rectangleA[Y]];

		for ($k = $j + 1; $k < $rowsCount; $k++) {
			if ($rectangleString === $table[$i][$k]) {
				$rectangleB[X] = $k;
			} else {
				break;
			}
		}

		for ($l = $i + 1; $l < $colsCount; $l++) {
			if ($rectangleString === $table[$l][$j]) {
				$rectangleB[Y] = $l;
			} else {
				break;
			}
		}

		$horizontal = array_slice($table[$rectangleA[X]])
	}
}
