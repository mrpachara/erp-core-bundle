<?php

namespace Erp\Bundle\CoreBundle\Service;

use Erp\Bundle\CoreBundle\Repository\ErpRepositoryInterface;
use Erp\Bundle\CoreBundle\Model\ThingInterface;

/**
 * ERP repository based Service Trait
 */
trait ErpRepositoryServiceTrait{
    /**
     * Domain-driven Repository
     *
     * @return ErpRepositoryInterface
     */
    protected function getRepository(){
        return $this->repository;
    }

    /**
     * @inheritDoc
     */
    public function find($id){
        return $this->getRepository()->find($id);
    }

    /**
     * @inheritDoc
     */
    public function findAll(){
        return $this->getRepository()->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null){
        return $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritDoc
     */
    public function findOneBy(array $criteria, array $orderBy = null){
        return $this->getRepository()->findOneBy($criteria, $orderBy);
    }

    /**
     * @inheritDoc
     */
    public function getClassName(){
        return $this->getRepository()->getClassName();
    }

    /**
     * @inheritDoc
     */
    public function save($entity){
        return $this->getRepository()->save($entity);
    }

    /**
     * @inheritDoc
     */
    public function remove($entity){
        return $this->getRepository()->remove($entity);
    }

    /**
     * @inheritDoc
     */
    public function thing(ThingInterface $thing){
        return $this->getRepository()->thing($entity);
    }

    /**
     * Adds support for magic finders.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return array|object The found entity/entities.
     *
     * @throws \BadMethodCallException If the method called is an invalid find* method
     *                                 or no find* method at all and therefore an invalid
     *                                 method call.
     */
    public function __call($method, $arguments)
    {
        switch(true){
            case (0 === strpos($method, 'findBy')):
                $by = substr($method, 6);
                $method = 'findBy';
                break;

            case (0 === strpos($method, 'findOneBy')):
                $by = substr($method, 9);
                $method = 'findOneBy';
                break;

            default:
                throw new \BadMethodCallException(
                    "Undefined method '$method'."
                );
        }

        if (empty($arguments)){
            throw new \BadMethodCallException(
                "You need to pass a parameter to '".$method . $by."'"
            );
        }

        $fieldName = lcfirst(\Doctrine\Common\Util\Inflector::classify($by));

        switch (count($arguments)) {
            case 1:
                return $this->$method(array($fieldName => $arguments[0]));

            case 2:
                return $this->$method(array($fieldName => $arguments[0]), $arguments[1]);

            case 3:
                return $this->$method(array($fieldName => $arguments[0]), $arguments[1], $arguments[2]);

            case 4:
                return $this->$method(array($fieldName => $arguments[0]), $arguments[1], $arguments[2], $arguments[3]);

            default:
                // Do nothing
        }

        throw new \BadMethodCallException(
            "Invalid parameter to '".$method . $by."'"
        );
    }
}
