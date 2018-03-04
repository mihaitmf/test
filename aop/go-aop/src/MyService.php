<?php

namespace GoAop;

class MyService
{
    public function doSomething()
    {
        echo '>>>>> doing something' . PHP_EOL;
    }

    public function doSomethingElse()
    {
        echo '>>>>> doing something else' . PHP_EOL;
    }

    public function otherMethod()
    {
        echo '>>>>> other method was called' . PHP_EOL;
    }
}
