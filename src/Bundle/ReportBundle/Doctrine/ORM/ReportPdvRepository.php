<?php

declare(strict_types=1);

namespace Bundle\ReportBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class ReportPdvRepository extends TianosEntityRepository
{
	
    public function findAllObjects()
    {
        return $this->createQueryBuilder('a')
            ->where('a.isActive = :active')
            ->orderBy('a.id', 'ASC')
            ->setParameter('active', true)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT rp
            FROM ReportBundle:ReportPdv rp
            WHERE
            rp.id = :id AND
            rp.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT rp
            FROM ReportBundle:ReportPdv rp
            WHERE
            rp.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllByPdvAndDate($pdvId = null, $openingDate = null): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT rp, pointofsaleOpening
            FROM ReportBundle:ReportPdv rp
            INNER JOIN rp.pointofsaleOpening pointofsaleOpening
            WHERE
            rp.isActive = :active AND
			pointofsaleOpening.pointOfSale = :pdvId AND
            SUBSTRING(pointofsaleOpening.openingDate, 1, 10) = :openingDate
            ";

        $query = $em->createQuery($dql);
	    $query->setParameter('active', 1);
	    $query->setParameter('pdvId', $pdvId);
	    $query->setParameter('openingDate', $openingDate->format('Y-m-d'));

        return $query->getResult();
    }
    

}
