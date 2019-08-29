<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Doctrine\ORM;

use Component\Category\Repository\CategoryRepositoryInterface;
use Component\TreeOneToMany\Repository\TreeOneToManyLeftRepositoryInterface;
use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class CategoryRepository extends TianosEntityRepository implements CategoryRepositoryInterface, TreeOneToManyLeftRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function deleteAssociativeTableLeft($id): bool
    {
        $em = $this->getEntityManager();
        $statement = $em->getConnection()->prepare('DELETE FROM category_has_product WHERE category_id = :id;');
        $statement->bindValue('id', $id);

        return $statement->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllOffsetLimit($offset = 0, $limit = 50): array
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o.id, o.code, o.name, o.createdAt')
            ->andWhere('o.isActive = :active')
            ->setParameter('active', 1)
            ->getQuery()
        ;

        $qb->setFirstResult($offset);
        $qb->setMaxResults($limit);

        return $qb->getResult();
    }

    public function findAllParentsByType($type): array
    {
	    $em = $this->getEntityManager();
	    $dql = "
            SELECT
            parent.id,
            parent.code,
            parent.name
			FROM CategoryBundle:Category parent
            WHERE
			parent.isActive = :active AND
            parent.type = :type_ AND
            parent.category IS NULL
            ORDER BY parent.id ASC
            ";

	    $query = $em->createQuery($dql);
	    $query->setParameter('active', 1);
	    $query->setParameter('type_', $type);

	    return $query->getResult();
    }
	
	
	/**
	 * Listar all Parents by type
	 */
    public function findAllParentsByTypeCOPY($pointOfSaleActiveId, $type): array
    {
	    $em = $this->getEntityManager();
	    $dql = "
            SELECT
            parent.id,
            parent.code,
            parent.name
            FROM PointofsaleBundle:Pointofsale pointOfSale
            LEFT JOIN pointOfSale.category parent
            WHERE
			pointOfSale.id = :pointOfSaleActiveId AND
			pointOfSale.isActive = :active AND
			parent.isActive = :active AND
            parent.type = :type_ AND
            parent.category IS NULL
            ORDER BY parent.id DESC
            ";

	    $query = $em->createQuery($dql);
	    $query->setParameter('active', 1);
	    $query->setParameter('type_', $type);
	    $query->setParameter('pointOfSaleActiveId', $pointOfSaleActiveId);

	    return $query->getResult();
    }

    public function findAllParents(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT parent
            FROM CategoryBundle:Category parent
            WHERE
            parent.isActive = :active AND
            parent.category IS NULL
            ORDER BY parent.id DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    public function findAllByParent($parent): array
    {
    	
    	$id = isset($parent['id']) ? $parent['id'] : null;
    	
        $em = $this->getEntityManager();
        $dql = "
            SELECT
            child.id,
            child.code,
            child.name
            FROM CategoryBundle:Category child
            WHERE
            child.isActive = :active AND
            child.category = :parent
            ORDER BY child.id ASC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('parent', $id);

        return $query->getResult();
    }

    public function findParentByChild($categoryId)
    {
    	
        $em = $this->getEntityManager();
        $dql = "
            SELECT
            obj.id,
            obj.name
            FROM CategoryBundle:Category obj
            WHERE
            obj.isActive = :active AND
            obj.category = :categoryId
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('categoryId', $categoryId);
        
        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT category
            FROM CategoryBundle:Category category
            WHERE
            category.id = :id AND
            category.isActive = :active
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

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT category
            FROM CategoryBundle:Category category
            WHERE
            category.isActive = :active
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

    /**
     * {@inheritdoc}
     */
    public function searchBoxLeft($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT category
            FROM CategoryBundle:Category category
            WHERE
            category.name LIKE :q AND
            category.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('q', '%' . $q . '%');
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }
}
