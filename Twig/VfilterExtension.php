<?php

namespace Erp\Bundle\CoreBundle\Twig;

class VfilterExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('vfilter', array(VfilterRuntime::class, 'vfilterFilter')),
        ];
    }
}
