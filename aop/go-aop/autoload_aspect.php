<?php

require_once dirname(__FILE__) . "/vendor/autoload.php";

\GoAop\ApplicationAspectKernel::getInstance()->init([
    'debug' => true, // Use 'false' for production mode
    'cacheDir' => __DIR__ . '/cache', // Adjust this path if needed
    'appDir' => __DIR__ . '/src',
]);
