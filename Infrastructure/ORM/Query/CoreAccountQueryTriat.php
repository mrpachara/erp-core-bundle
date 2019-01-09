<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Query;

use Erp\Bundle\CoreBundle\Entity\CoreAccount;

/**
 *
 * @author pachara
 *        
 */
trait CoreAccountQueryTriat
{
    /**
     * {@inheritdoc}
     */
    public function getRelatedAccount(CoreAccount $account): array
    {
        $qb = $this->repos->createQueryBuilder('_entity');
        
        return $this->qh->queryByThing($qb, $account->getThing())->getQuery()->getResult();
    }
}

