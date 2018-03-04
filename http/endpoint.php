<?php

$post = $_POST;

$phpInput = file_get_contents('php://input');

$filename = 'output/output_java.txt';

//file_put_contents($filename, ''); // clear file

$delimiter = '//////////////////////////////////////////////////////////';

$fh = fopen($filename, 'w+');
$return = $delimiter . ' $_POST' . PHP_EOL . PHP_EOL . print_r($post, true) . PHP_EOL
    . $delimiter . ' file_get_contents(\'php://input\')' . PHP_EOL . PHP_EOL . print_r($phpInput, true) . PHP_EOL
    . $delimiter . ' json_decode($phpInput)' . PHP_EOL . PHP_EOL . print_r(json_decode($phpInput), true) . PHP_EOL
    . $delimiter . ' getallheaders()' . PHP_EOL . PHP_EOL . print_r(getallheaders(), true) . PHP_EOL
    . $delimiter . ' $_SERVER' . PHP_EOL . PHP_EOL . print_r($_SERVER, true);
fwrite($fh, $return);
fclose($fh);

echo $return;
