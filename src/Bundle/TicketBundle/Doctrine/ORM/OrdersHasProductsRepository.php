<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class OrdersHasProductsRepository extends TianosEntityRepository
{

    /**
     * {@inheritdoc}
     */
    public function findAllBySales($id)
    {
	    $em = $this->getEntityManager();
        $dql = "
            SELECT o, product, category
            FROM TicketBundle:OrdersHasProducts o
            INNER JOIN o.product product
            INNER JOIN product.category category
            WHERE
            o.orders = :id
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getResult();
    }

}
