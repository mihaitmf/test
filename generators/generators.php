<?php

$FILE_NAME = "file.txt";
file_put_contents($FILE_NAME, "aaaaaadsadsada\nbbbbsadasasda\nccccccawsdsadsa\nddddddduui998dsah");

$generatorReader = function ($fileName) {
    $file = fopen($fileName, "r");

    $i = 0;
    while (($line = fgets($file)) !== false) {
        $i++;
        yield "Line#{$i}" => $line;
    }

    fclose($file);
};

$arrayReader = function ($fileName) {
    $file = fopen($fileName, "r");

    $linesRead = [];
    $i = 0;
    while (($line = fgets($file)) !== false) {
        $i++;
        $linesRead["Line#{$i}"] = $line;
    }

    fclose($file);

    return $linesRead;
};

$memoryUsagePrinter = function (Closure $reader, $fileName, $fileReaderName) {
    $initialMemoryUsage = memory_get_usage();

    $fileLines = $reader($fileName);
    foreach ($fileLines as $key => $fileLine) {
        echo $key . ": " . $fileLine;
    }

    $diffMemoryUsage = memory_get_usage() - $initialMemoryUsage;
    printf("\nMemory used by reading the file with the %s: %d B\n", $fileReaderName, $diffMemoryUsage);
};

$memoryUsagePrinter($arrayReader, $FILE_NAME, "ArrayReader");
$memoryUsagePrinter($generatorReader, $FILE_NAME, "GeneratorReader");
