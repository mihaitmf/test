<?php

use GoAop\MyService;

require_once dirname(__FILE__) . "/vendor/autoload.php";
require_once dirname(__FILE__) . "/autoload_aspect.php";

$service = new MyService();
$service->doSomething();
$service->doSomethingElse();
$service->otherMethod();
