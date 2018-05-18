<?php

namespace Erp\Bundle\CoreBundle\Serializer;

use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\JsonDeserializationVisitor;

class JsonOrArrayDeserializationVisitor extends JsonDeserializationVisitor {
  protected function decode($str) {
    if(is_array($str)) return $str;

    return parent::decode($str);
  }
}
