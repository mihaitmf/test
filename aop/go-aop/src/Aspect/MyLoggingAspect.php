<?php

namespace GoAop\Aspect;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\After;

class MyLoggingAspect implements Aspect
{
    /**
     * @param MethodInvocation $invocation
     * @Before("execution(public GoAop\MyService->do*(*))")
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        echo 'Calling Before Interceptor for ',
        $invocation,
        ' with arguments: ',
        json_encode($invocation->getArguments()),
        PHP_EOL;
    }

    /**
     * @param MethodInvocation $invocation
     * @After("execution(public GoAop\MyService->do*Else(*))")
     */
    public function afterOnlyOneMethodExecution(MethodInvocation $invocation)
    {
        echo "Aspect called after {$invocation}" . PHP_EOL;
    }
}
