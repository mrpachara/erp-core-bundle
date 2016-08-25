<?php

namespace Erp\Bundle\CoreBundle\Model;

/**
 * Core account Interface
 */
interface CoreAccountInterface{
    /**
     * Get id
     *
     * @return string
     */
    public function getId();

    /**
     * Set thing
     *
     * @param ThingInterface $thing
     *
     * @return CoreAccountInterface
     */
    public function setThing(ThingInterface $thing);

    /**
     * Get thing
     *
     * @return ThingInterface
     */
    public function getThing();

    /**
     * Set code
     *
     * @param string $code
     *
     * @return CoreAccountInterface
     */
    public function setCode(string $code);

    /**
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CoreAccountInterface
     */
    public function setName(string $name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();
}
