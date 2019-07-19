<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class UnitRepository extends TianosEntityRepository
{

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT unit
            FROM ProductBundle:Unit unit
            WHERE
            unit.id = :id AND
            unit.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
	
	/**
	 * {@inheritdoc}
	 */
	public function findAllObjects()
	{
		return $this->createQueryBuilder('o')
			->where('o.isActive = :active')
			->orderBy('o.id', 'ASC')
			->setParameter('active', true)
			;
	}

}
