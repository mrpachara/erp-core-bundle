<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Helper;

class AliasUniqueGenerator
{
    private $index;
    
    public function __construct()
    {
        $this->index = 0;
    }
    
    public function unique(string $prefix): string
    {
        return ($prefix ?: '').$this->index++;
    }
}

