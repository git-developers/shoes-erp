<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Product\Repository\ProductRepositoryInterface;

class ProductRepository extends TianosEntityRepository implements ProductRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT product
            FROM ProductBundle:Product product
            WHERE
            product.id = :id AND
            product.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);
        
        return $query->getOneOrNullResult();
    }
    
    /**
     * {@inheritdoc}
     */
    public function findOne($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT product, category
            FROM ProductBundle:Product product
            INNER JOIN product.category category
            WHERE
            product.id = :id AND
            product.isActive = :active
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
            SELECT product
            FROM ProductBundle:Product product
            WHERE
            product.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllByCategoryId($categoryId): array
    {

        $em = $this->getEntityManager();
        $dql = "
            SELECT product
            FROM ProductBundle:Product product
            WHERE
            product.isActive = :active AND
            product.category = :categoryId
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('categoryId', $categoryId);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllByCategory($category): array
    {
	    $categoryId = isset($category['id']) ? $category['id'] : null;
        return $this->findAllByCategoryId($categoryId);
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
