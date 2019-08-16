<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class PointofsaleOpeningRepository extends TianosEntityRepository {

    /**
     * {@inheritdoc}
     */
    public function findOneByPdvAndDate($pdvId = null, $openingDate = null)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT po.id
            FROM PointofsaleBundle:PointofsaleOpening po
            WHERE
            po.isActive = :active AND
            po.pointOfSale = :pdvId AND
            SUBSTRING(po.openingDate, 1, 10) = :openingDate
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('pdvId', $pdvId);
	    $query->setParameter('openingDate', $openingDate->format('Y-m-d'));
	    
	    return $query->getSingleScalarResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByHash($pdvHash = null)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT po
            FROM PointofsaleBundle:PointofsaleOpening po
            WHERE
            po.isActive = :active AND
            po.pdvHash = :pdvHash
            ";
	    
        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('pdvHash', $pdvHash);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByPdvAndNow($pdvId = null)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT po
            FROM PointofsaleBundle:PointofsaleOpening po
            WHERE
            po.isActive = :active AND
            po.pointOfSale = :pdvId AND
            SUBSTRING(po.openingDate, 1, 10) = :openingDate
            ";
	
	    $openingDate = new \DateTime("NOW");
	    $openingDate = $openingDate->format('Y-m-d');
	    
        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('pdvId', $pdvId);
	    $query->setParameter('openingDate', $openingDate);

        return $query->getOneOrNullResult();
    }

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
            SELECT pdv
            FROM PointofsaleBundle:PointofsaleOpening pdv
            WHERE
            pdv.id = :id AND
            pdv.isActive = :active
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
            SELECT pdv
            FROM PointofsaleBundle:PointofsaleOpening pdv
            WHERE
            pdv.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

}
