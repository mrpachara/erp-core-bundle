<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Query;

use Erp\Bundle\CoreBundle\Entity\CoreAccount;
use Erp\Bundle\CoreBundle\Infrastructure\ORM\Helper\CoreAccountQueryHelper;

/**
 *
 * @author pachara
 *        
 */
trait CoreAccountQueryTriat
{
    use ErpQueryTriat;

    /**
     * @var CoreAccountQueryHelper $qh
     */
    private $qh;

    /**
     * {@inheritdoc}
     */
    public function getRelatedAccount(CoreAccount $account, $lockMode = null): array
    {
        $qb = $this->repos->createQueryBuilder('_entity');
        
        return $this->qh->queryByThing($qb, $account->getThing())->getQuery()->setLockMode($lockMode)->getResult();
    }
}

