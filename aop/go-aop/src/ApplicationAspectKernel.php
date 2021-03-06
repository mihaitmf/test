<?php

namespace GoAop;

use Go\Core\AspectContainer;
use Go\Core\AspectKernel;
use GoAop\Aspect\MyLoggingAspect;

class ApplicationAspectKernel extends AspectKernel
{

    /**
     * Configure an AspectContainer with advisors, aspects and pointcuts
     *
     * @param AspectContainer $container
     *
     * @return void
     */
    protected function configureAop(AspectContainer $container)
    {
        $container->registerAspect(new MyLoggingAspect());
    }
}
