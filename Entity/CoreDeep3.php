<?php

namespace Erp\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="public.deep3")
 * @ORM\InheritanceType("JOINED")
 */
class CoreDeep3 extends CoreDeep2{
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $att3;

    public function __construct(){
        parent::__construct();
    }

    public function setAtt3(string $att3){
        $this->att3 = $att3;

        return $this;
    }

    public function getAtt3(){
        return $this->att3;
    }
}
