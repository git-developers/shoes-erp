<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Ticket\Model\TicketInterface;
use Component\Ticket\Repository\TicketRepositoryInterface;

class PaymentTypeRepository extends TianosEntityRepository implements TicketRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT paymentType
            FROM TicketBundle:PaymentType paymentType
            WHERE
            paymentType.id = :id AND
            paymentType.isActive = :active
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
            SELECT paymentType
            FROM TicketBundle:PaymentType paymentType
            WHERE
            paymentType.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
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
	
	public function findByNamePart(string $phrase, string $locale): array
	{
	
	}
}
