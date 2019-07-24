<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Ticket\Repository\TicketRepositoryInterface;

class TicketHasProductsRepository extends TianosEntityRepository
{

    /**
     * {@inheritdoc}
     */
    public function findAllByTicket($idTicket)
    {
	    $em = $this->getEntityManager();
        $dql = "
            SELECT a
            FROM TicketBundle:TicketHasProducts a
            WHERE
            a.ticket = :idTicket
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('idTicket', $idTicket);

        return $query->getResult();
    }

}
