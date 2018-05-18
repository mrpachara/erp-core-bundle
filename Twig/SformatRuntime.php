<?php

namespace Erp\Bundle\CoreBundle\Twig;

class SformatRuntime
{
    public function sformatFilter($str, $format, $ignorEmpty = true)
    {
        if($ignorEmpty && empty($str)) return $str;

        return sprintf($format, $str);
    }
}
