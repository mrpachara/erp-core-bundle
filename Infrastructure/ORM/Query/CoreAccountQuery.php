<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Query;

use Erp\Bundle\CoreBundle\Domain\CQRS\Query\CoreAccountQuery as QueryInterface;
use Erp\Bundle\CoreBundle\Entity\CoreAccount;
use Erp\Bundle\CoreBundle\Infrastructure\ORM\Helper\CoreAccountQueryHelper;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityRepository;

/**
 *
 * @author pachara
 *        
 */
class CoreAccountQuery implements QueryInterface
{

    use CoreAccountQueryTriat;
    
    /**
     * @var EntityRepository
     */
    private $repos;
    
    private $qh;
    
    /**
     */
    public function __construct(
        RegistryInterface $doctrine,
        CoreAccountQueryHelper $qh
    )
    {
        $this->repos = $doctrine->getRepository(CoreAccount::class);
        $this->qh = $qh;
    }
}

