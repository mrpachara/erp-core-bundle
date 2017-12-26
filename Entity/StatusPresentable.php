<?php

namespace Erp\Bundle\CoreBundle\Entity;

/**
 * Entity can present updatable and delatable
 */
interface StatusPresentable{
  /**
   * If can update
   *
   * @return bool
   */
  public function updatable();

  /**
   * If can delete
   *
   * @return bool
   */
  public function deletable();
}
