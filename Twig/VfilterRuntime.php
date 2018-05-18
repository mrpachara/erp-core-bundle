<?php

namespace Erp\Bundle\CoreBundle\Twig;

class VfilterRuntime
{
    public function vfilterFilter($items, $value, $exclude = false)
    {
        $result = [];
        $items = (array)$items;
        
        foreach($items as $item) {
            if((!$exclude)? ($item == $value) : ($item != $value)) $result[] = $item;
        }

        return $result;
    }
}
