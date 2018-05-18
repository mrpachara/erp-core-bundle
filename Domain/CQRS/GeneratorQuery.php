<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

use Erp\Bundle\CoreBundle\Entity\Generator;

/**
 * Generator Query (CQRS)
 */
interface GeneratorQuery extends ErpQuery{
  /**
   * get generator
   *
   * @param string $code
   *
   * @return Generator
   */
  function generator(string $code);
}
