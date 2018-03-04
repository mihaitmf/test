<?php

use Demo\Aspect\AwesomeAspectKernel;
use Demo\Example\HumanDemo;
use Go\Aop\Features;

include __DIR__ . '/vendor/goaop/framework/demos/autoload.php';

// Initialize demo aspect container
AwesomeAspectKernel::getInstance()->init(array(
    'debug'    => true,
    'appDir'   => __DIR__ . '/vendor/goaop/framework/demos',
    'cacheDir' => __DIR__ . '/cache',

    'features' => Features::INTERCEPT_FUNCTIONS,
));

$example = new HumanDemo();
echo "Want to eat something, let's have a breakfast!", PHP_EOL;
$example->eat();
echo "I should work to earn some money", PHP_EOL;
$example->work();
echo "It was a nice day, go to bed", PHP_EOL;
$example->sleep();
