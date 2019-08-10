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
	public function deleteAssociativeTableById($id): bool
	{
//        return $em->getConnection()
//            ->prepare('DELETE FROM profile_has_role WHERE profile_id = :id;')
//            ->bindValue('id', $id)
//            ->execute()
//            ;
		
		$em = $this->getEntityManager();
		$sql = "DELETE FROM point_of_sale_has_product WHERE product_id = :id;";
		$params = ['id' => $id];
		
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute($params);
		
		// puesto provisional
		return true;
	}

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
    public function findAllByCategoryAndPdv($pdvId, $categoryId): array
    {
	
	
//	    LEFT JOIN product.pointOfSale pointOfSale
//	    pointOfSale.id = :pdvId

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
//        $query->setParameter('pdvId', $pdvId);
        $query->setParameter('categoryId', $categoryId);
	
	
//	    echo "POLLO:: <pre>";
//	    print_r($query->getSQL());
//	    exit;
        
        
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
