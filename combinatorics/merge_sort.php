<?php

function mergeSort(array $v, $low, $high)
{
    if ($low < $high) {
        $mid = (int)(($low + $high)/2);
        $firstHalf = mergeSort($v, $low, $mid);
        $secondHalf = mergeSort($v, $mid + 1, $high);

        return merge($firstHalf, $secondHalf);
    }

    return [$v[$low]];
}

function merge(array $firstHalf, array $secondHalf)
{
    $i = $j = 0;
    $k = 0;
    $result = [];
    while ($i < count($firstHalf) && $j < count($secondHalf)) {
        if ($firstHalf[$i] < $secondHalf[$j]) {
            $result[$k++] = $firstHalf[$i++];
        } else {
            $result[$k++] = $secondHalf[$j++];
        }
    }

    while ($i < count($firstHalf)) {
        $result[$k++] = $firstHalf[$i++];
    }

    while ($j < count($secondHalf)) {
        $result[$k++] = $secondHalf[$j++];
    }

    return $result;
}

$v = [5, 1, -4, 10, 0, 3, 5, 2];
$sorted = mergeSort($v, 0, count($v) - 1);
foreach($sorted as $x) {
    echo $x . ' ';
};
