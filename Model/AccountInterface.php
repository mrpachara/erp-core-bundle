<?php

namespace Erp\Bundle\CoreBundle\Model;

interface AccountInterface{
    /**
     * Get id
     *
     * @return string
     */
    public function getId();

    /**
     * Set code
     *
     * @param string $code
     *
     * @return AccountInterface
     */
    public function setCode($code);

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
     * @return AccountInterface
     */
    public function setName($name);
}
