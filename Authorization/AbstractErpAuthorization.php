<?php

namespace Erp\Bundle\CoreBundle\Authorization;

use Erp\Bundle\CoreBundle\Entity\StatusPresentable;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

abstract class AbstractErpAuthorization
{
    /** @var Security */
    protected $security;

    /** @required */
    public function setSecurity(Security $security)
    {
        $this->security = $security;
    }

    /** @var AuthorizationCheckerInterface */
    protected $authorizationChecker;

    /** @required */
    public function setAuthorizationChecker(AuthorizationCheckerInterface $authorizationChecker)
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
