<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Ticket\Repository\TicketRepositoryInterface;

class TicketHasServicesRepository extends TianosEntityRepository
{

    /**
     * {@inheritdoc}
     */
    public function findAllByService($idTicket)
    {
	    $em = $this->getEntityManager();
        $dql = "
            SELECT ths
            FROM TicketBundle:TicketHasServices ths
            WHERE
            ths.ticket = :idTicket
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('idTicket', $idTicket);

        return $query->getResult();
    }

}
