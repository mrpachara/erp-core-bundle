<?php

namespace Erp\Bundle\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Erp\Bundle\CoreBundle\DependencyInjection\Compiler\SearchQueryRegistryPass;

class ErpCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SearchQueryRegistryPass());
    }
}
