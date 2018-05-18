<?php

namespace Erp\Bundle\CoreBundle\Authorization;

use Erp\Bundle\CoreBundle\Entity\StatusPresentable;

abstract class AbstractErpAuthorization
{
    /** @var \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface */
    protected $authorizationChecker;
    
    /** @required */
    public function setAuthorizationChecker(\Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function list(...$args) {
        return true;
    }

    public function get(...$args) {
        return true;
    }

    public function add(...$args) {
        return true;
    }

    public function edit(...$args) {
        $result = true;
        if(isset($args[0])) {
            if($result && ($args[0] instanceof StatusPresentable)) {
                $result = $result && $args[0]->updatable();
            }
        }
        return $result;
    }

    public function delete(...$args) {
        $result = true;
        if(isset($args[0])) {
            if($result && ($args[0] instanceof StatusPresentable)) {
                $result = $result && $args[0]->deletable();
            }
        }
        return $result;
    }
}
