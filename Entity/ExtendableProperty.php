<?php

namespace Erp\Bundle\CoreBundle\Entity;

/**
 * Property for extendable entity
 */
interface ExtendableProperty {
  /**
   * Entity type
   *
   * @return string
   */
  public function getDtype();
}
