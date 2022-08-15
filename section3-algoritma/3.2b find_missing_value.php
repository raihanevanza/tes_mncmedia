<?php

function getMissingValue($array)
{
    $min = min($array); // get smallest value of array
    $max = max($array); // get highest value of array
    $missing_value = []; // list missing value
    $list_number = groupingValue($array);

    for ($i = $min; $i < $max; $i++) {
        if (!isset($list_number[$i])) {
            $missing_value[] = $i;
        }
    }

    return implode(',', $missing_value);
}

function groupingValue($array)
{
    $number = [];

    foreach ($array as $value) {
        $number[$value] = $value;
    }

    return $number;
}

echo getMissingValue([
    1, 2, 3,
    5, 6, 9, 8, 7
]);
