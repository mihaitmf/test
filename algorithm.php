<?php


function algo(array $input) {
    array_walk(
        $input,
        function(&$value, $key, $arr) {
            $value = 1;
            foreach ($arr as $k => $v) {
                if ($k == $key) {
                    continue;
                }
                $value *= $v;
            }
        },
        $input
    );

    return $input;
}

$input = [1, 7, 3, 4];
print_r(algo($input));
