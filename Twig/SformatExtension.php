<?php

namespace Erp\Bundle\CoreBundle\Twig;

class SformatExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('sformat', array(SformatRuntime::class, 'sformatFilter')),
        ];
    }
}
