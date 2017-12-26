<?php

namespace Erp\Bundle\CoreBundle\Serializer;

use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\VisitorInterface;
use Erp\Bundle\CoreBundle\Domain\CQRS\ErpQuery;

/**
 * Object Constructor that call entity constructor
 */
class ObjectConstructor implements ObjectConstructorInterface{
  /** @var ObjectConstructorInterface */
  private $fallbackConstructor;

  /**
   * Constructor.
   *
   * @param ObjectConstructorInterface $fallbackConstructor Fallback object constructor
   */
  public function __construct(ObjectConstructorInterface $fallbackConstructor){
    $this->fallbackConstructor = $fallbackConstructor;
  }

  public function construct(
    VisitorInterface $visitor,
    ClassMetadata $metadata,
    $data,
    array $type,
    DeserializationContext $context
  ){
    if($context->attributes->containsKey('repository')){
      /** @var ErpQuery $repository */
      $repository = $context->attributes->get('repository')->get();

      if($metadata->name == $repository->getClassName()){
        if($context->attributes->containsKey('id')){
          $id = $context->attributes->get('id')->get();

          return $repository->find($id);
        } else{
          return $repository->create();
        }
      }
    }

    return $this->fallbackConstructor->construct($visitor, $metadata, $data, $type, $context);
  }
}
