<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Ticket\Repository\TicketRepositoryInterface;

class PaymentHistoryRepository extends TianosEntityRepository implements TicketRepositoryInterface
{
	
	/**
	 * {@inheritdoc}
	 */
	public function findAllBySales($salesId): array
	{
		$em = $this->getEntityManager();
		$dql = "
            SELECT ph
            FROM TicketBundle:PaymentHistory ph
            WHERE
            ph.isActive = :active AND
            ph.sales = :salesId
            ";
		
		$query = $em->createQuery($dql);
		$query->setParameter('active', 1);
		$query->setParameter('salesId', $salesId);
		
		return $query->getResult();
	}
	
    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT ph
            FROM TicketBundle:PaymentHistory ph
            WHERE
            ph.id = :id AND
            ph.isActive = :active
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
            SELECT ph
            FROM TicketBundle:PaymentHistory ph
            WHERE
            ph.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.name = :name')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findByNamePart(string $phrase, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult()
        ;
    }
}
