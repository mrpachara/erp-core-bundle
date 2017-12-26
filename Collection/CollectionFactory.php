<?php

namespace Erp\Bundle\CoreBundle\Collection;

class CollectionFactory {

  /**
   * create map
   *
   * @param array|null $data
   *
   * @return \PhpCollection\MapInterface
   */
  function map(array $data = null) {
    $data = (array)$data;
    return new \PhpCollection\Map($data);
  }
}
