<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class SalesHasProductsRepository extends TianosEntityRepository
{

    /**
     * {@inheritdoc}
     */
    public function findAllBySales($id)
    {
	    $em = $this->getEntityManager();
        $dql = "
            SELECT a
            FROM TicketBundle:SalesHasProducts a
            WHERE
            a.sales = :id
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getResult();
    }

}
