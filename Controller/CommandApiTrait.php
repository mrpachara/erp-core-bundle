<?php

namespace Erp\Bundle\CoreBundle\Controller;

/**
 * Default API command
 */
trait CommandApiTrait {
  /**
   * @var \Erp\Bundle\CoreBundle\Serializer\Serializer
   */
  protected $serializer;

  /**
   * @var \Erp\Bundle\CoreBundle\Domain\CQRS\CQRSContainer
   */
  protected $cqrs;

  /**
   * default create item
   *
   * @param string|array|object $data
   * @param string $format
   */
  protected function createCommand($data, string $format) {
    $item = $this->cqrs->command()->create();
    $this->cqrs->command()->transactional(function () use ($item, $data, $format) {
      $this->serializer->deserializeToExisted(
        $item,
        $data,
        $this->cqrs->command()->getClassName(),
        $format
      );
    });

    return ['data' => $item];
  }

  /**
   * default update item
   *
   * @param mixed $item
   * @param string|array|object $data
   * @param string $format
   */
  protected function updateCommand($item, $data, string $format) {
    $this->cqrs->command()->transactional(function ($em) use ($item, $data, $format) {
      $this->serializer->deserializeToExisted(
        $item,
        $data,
        $this->cqrs->command()->getClassName(),
        $format
      );

      $em->refresh($item);
    });

    return ['data' => $item];
  }

  /**
   * default delete item
   *
   * @param mixed $item
   */
  protected function deleteCommand($item) {
    $this->cqrs->command()->transactional(function () use ($item) {
      $this->cqrs->command()->remove($item);
    });

    return ['data' => $item];
  }
}
