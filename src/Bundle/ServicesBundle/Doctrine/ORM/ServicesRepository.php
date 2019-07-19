<?php

declare(strict_types=1);

namespace Bundle\ServicesBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Services\Repository\ServicesRepositoryInterface;

class ServicesRepository extends TianosEntityRepository implements ServicesRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT services
            FROM ServicesBundle:Services services
            WHERE
            services.id = :id AND
            services.isActive = :active
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
            SELECT services
            FROM ServicesBundle:Services services
            WHERE
            services.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllByIds(array $ids): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT services
            FROM ServicesBundle:Services services
            WHERE
            services.isActive = :active AND
            services.id IN (:ids)
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
	    $query->setParameter('ids', $ids);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllByCategory($category): array
    {
	
	    $categoryId = isset($category['id']) ? $category['id'] : null;
    	
        $em = $this->getEntityManager();
        $dql = "
            SELECT services
            FROM ServicesBundle:Services services
            WHERE
            services.isActive = :active AND
            services.category = :categoryId
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('categoryId', $categoryId);
        
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
