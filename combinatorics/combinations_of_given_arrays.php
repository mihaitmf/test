<?php
/*
Given an array with the following structure:
[
    ['A', 'B'],
    [1, 2, 3],
    ['x', 'y']
]

Write a function that generates an array with all the following combinations:
[
    ['A', 1, 'x'],
    ['A', 1, 'y'],
    ['A', 2, 'x'],
    ['A', 2, 'y'],
    ['A', 3, 'x'],
    ['A', 3, 'y'],
    ['B', 1, 'x'],
    ['B', 1, 'y'],
    ['B', 2, 'x'],
    ['B', 2, 'y'],
    ['B', 3, 'x'],
    ['B', 3, 'y']
]
*/

$givenArrays = [
    ['A', 'B'],
    [1, 2, 3],
    ['x', 'y'],
];

$combinations = generateCombinationsOfMultipleArrays($givenArrays);

printCombinations($combinations);
die();

function generateCombinationsOfMultipleArrays(array $givenArrays)
{
    if (count($givenArrays) == 1) {
        return $givenArrays[0];
    }

    $combinationsOfFirstTwoArrays = generateCombinationsOfTwoArrays($givenArrays[0], $givenArrays[1]);
    $remainingGivenArrays = array_slice($givenArrays, 2);
    $newGivenArrays = array_merge([$combinationsOfFirstTwoArrays], $remainingGivenArrays);

    return generateCombinationsOfMultipleArrays($newGivenArrays);
}

function generateCombinationsOfTwoArrays(array $array1, array $array2)
{
    $combinations = [];

    for ($i = 0; $i < count($array1); $i++) {
        for ($j = 0; $j < count($array2); $j++) {
            if (is_array($array1[$i])) {
                $combinations[] = array_merge($array1[$i], [$array2[$j]]);
            } else {
                $combinations[] = [$array1[$i], $array2[$j]];
            }
        }
    }

    return $combinations;
}

function printCombinations($combinations)
{
    foreach ($combinations as $combination) {
        foreach ($combination as $value) {
            echo $value . ' ';
        }
        echo PHP_EOL;
    }
}
