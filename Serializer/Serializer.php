<?php

namespace Erp\Bundle\CoreBundle\Serializer;

use JMS\Serializer\Serializer as JMSSerializer;

use JMS\Serializer\ContextFactory\DeserializationContextFactoryInterface;

class Serializer extends JMSSerializer {
  private $deserializationContextFactory;

  function setDeserializationContextFactory(DeserializationContextFactoryInterface $factory){
    $this->deserializationContextFactory = $factory;

    return parent::setDeserializationContextFactory($factory);
  }

  /**
  * Deserializes the given data to the specified type.
  *
  * @param object|array|mixed $existed
  * @param string $data
  * @param string $type
  * @param string $format
  *
  * @return object|array|mixed
   */
  function deserializeToExisted($existed, $data, $type, $format) {
    $context = $this->deserializationContextFactory->createDeserializationContext();
    $context->setAttribute('existedObject', $existed);
    return $this->deserialize($data, $type, $format, $context);
  }
}
