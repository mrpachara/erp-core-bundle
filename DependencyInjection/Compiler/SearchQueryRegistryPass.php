<?php

namespace Erp\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

use Erp\Bundle\CoreBundle\Infrastructure\ORM\Service\SearchQueryRegistry;

class SearchQueryRegistryPass implements CompilerPassInterface
{
    const TAG_NAME = 'erp_core.search_query';

    public function process(ContainerBuilder $container)
    {
        // always first check if the primary service is defined
        if (!$container->has(SearchQueryRegistry::class)) {
            return;
        }

        $definition = $container->findDefinition(SearchQueryRegistry::class);

        // find all service IDs with the self::TAG_NAME
        $taggedServices = $container->findTaggedServiceIds(self::TAG_NAME);
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('register', [new Reference($id)]);
        }
    }
}
