<?php
namespace Erp\Bundle\CoreBundle\Twig;

/**
 *
 * @author Asus
 *        
 */
class AsumExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('asum', array(AsumRuntime::class, 'asumFilter')),
        ];
    }
}

