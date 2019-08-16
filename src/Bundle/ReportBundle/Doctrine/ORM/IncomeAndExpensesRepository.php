<?php

declare(strict_types=1);

namespace Bundle\ReportBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class IncomeAndExpensesRepository extends TianosEntityRepository
{
	
	/**
	 * {@inheritdoc}
	 */
	public function deleteAllByPdvAndNow($pdvId = null): bool
	{
		
		$openingDate = new \DateTime("NOW");
		$openingDate = $openingDate->format('Y-m-d');
		
		$em = $this->getEntityManager();
		$sql = "
			DELETE ie.* FROM pointofsale_opening po
			INNER JOIN income_and_expenses ie ON ie.pointofsale_opening_id = po.id
			WHERE
			po.point_of_sale_id = :pdvId AND
			SUBSTRING(ie.opening_date, 1, 10) = :openingDate;
				";
		$params = [
			'pdvId' => $pdvId,
			'openingDate' => $openingDate,
		];
		
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute($params);
		
		// puesto provisional
		return true;
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
            SELECT ie
            FROM ReportBundle:IncomeAndExpenses ie
            WHERE
            ie.id = :id AND
            ie.isActive = :active
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
            SELECT ie
            FROM ReportBundle:IncomeAndExpenses ie
            WHERE
            ie.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }
	
	/**
	 * {@inheritdoc}
	 */
	public function findAllByPdvAndNow($pdvId = null, $openingDate = null): array
	{
		$em = $this->getEntityManager();
		$dql = "
            SELECT ie, pointofsaleOpening
            FROM ReportBundle:IncomeAndExpenses ie
            INNER JOIN ie.pointofsaleOpening pointofsaleOpening
            WHERE
            ie.isActive = :active AND
			pointofsaleOpening.pointOfSale = :pdvId AND
            SUBSTRING(pointofsaleOpening.openingDate, 1, 10) = :openingDate
            ORDER BY ie.id ASC
            ";
		
		$query = $em->createQuery($dql);
		$query->setParameter('active', 1);
		$query->setParameter('pdvId', $pdvId);
		$query->setParameter('openingDate', $openingDate->format('Y-m-d'));
		
		return $query->getResult();
	}

}
