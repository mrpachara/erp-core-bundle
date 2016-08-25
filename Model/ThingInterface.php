<?php

namespace Erp\Bundle\CoreBundle\Model;

/**
 */
interface ThingInterface{
    /**
     * Get id
     *
     * @return string
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ThingInterface
     */
    public function setName(string $name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();
}
