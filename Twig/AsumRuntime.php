<?php
namespace Erp\Bundle\CoreBundle\Twig;

/**
 *
 * @author Asus
 *        
 */
class AsumRuntime
{
    public function asumFilter($ar, $fieldName = null)
    {
        return array_reduce($ar, function($carry, $value) use ($fieldName) {
            return $carry + ((empty($fieldName))? $value : $value[$fieldName] );
        }, 0);
    }
}
