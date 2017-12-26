<?php

namespace Erp\Bundle\CoreBundle\Entity;

/**
 * Thing Entity
 */
class Thing{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $active = true;

    /**
     * Get id
     *
     * @return string
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Thing
     */
    public function setName(string $name){
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Set active
     *
     * @param bool $active
     *
     * @return Thing
     */
    public function setActive(bool $active){
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive(){
        return $this->active;
    }
}
