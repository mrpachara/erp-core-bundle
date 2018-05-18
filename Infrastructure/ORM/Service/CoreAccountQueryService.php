<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

class CoreAccountQueryService extends CoreAccountQuery
{
    /** @required */
    public function setRepository(\Symfony\Bridge\Doctrine\RegistryInterface $doctrine)
    {
        $this->repository = $doctrine->getRepository('ErpCoreBundle:CoreAccount');
    }
}
