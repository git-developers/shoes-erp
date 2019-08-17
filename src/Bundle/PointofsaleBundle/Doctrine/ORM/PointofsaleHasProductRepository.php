<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class PointofsaleHasProductRepository extends TianosEntityRepository
{
	
	/**
	 * {@inheritdoc}
	 */
	public function deletePdvHasProduct($id): bool
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
    public function findByPdv($pdvId = null)
    {
	    $em = $this->getEntityManager();
        $dql = "
            SELECT pdvHasProduct, pdv, product
            FROM PointofsaleBundle:PointofsaleHasProduct pdvHasProduct
            LEFT JOIN pdvHasProduct.pointOfSale pdv
            LEFT JOIN pdvHasProduct.product product
            WHERE
            pdv.id = :pdvId AND
            product.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('pdvId', $pdvId);
	    $query->setParameter('active', 1);
		
        return $query->getResult();
    }
    
    /**
     * {@inheritdoc}
     */
    public function findByPdvAndProduct($pdvId = null, $productId = null)
    {
	    $em = $this->getEntityManager();
        $dql = "
            SELECT pdvHasProduct, pdv, product
            FROM PointofsaleBundle:PointofsaleHasProduct pdvHasProduct
            LEFT JOIN pdvHasProduct.pointOfSale pdv
            LEFT JOIN pdvHasProduct.product product
            WHERE
            pdv.id = :pdvId AND
            product.id = :productId AND
            product.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('pdvId', $pdvId);
        $query->setParameter('productId', $productId);
	    $query->setParameter('active', 1);
		
        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findByPdvAndCategory($pdvId, $categoryId)
    {
	    $em = $this->getEntityManager();
        $dql = "
            SELECT pdvHasProduct, pdv, product, category
            FROM PointofsaleBundle:PointofsaleHasProduct pdvHasProduct
            LEFT JOIN pdvHasProduct.pointOfSale pdv
            INNER JOIN pdvHasProduct.product product
            INNER JOIN product.category category
            WHERE
            pdv.id = :pdvId AND
            category.id = :categoryId AND
            product.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('pdvId', $pdvId);
        $query->setParameter('categoryId', $categoryId);
	    $query->setParameter('active', 1);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pdvHasProduct
            FROM PointofsaleBundle:PointofsaleHasProduct pdvHasProduct
            WHERE
            pdvHasProduct.id = :id AND
            pdvHasProduct.isActive = :active
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
            SELECT pdvHasProduct
            FROM PointofsaleBundle:PointofsaleHasProduct pdvHasProduct
            WHERE
            pdvHasProduct.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }


    /**
     * {@inheritdoc}
     */
    public function findAllByProduct($productId): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pdvHasProduct, product
            FROM PointofsaleBundle:PointofsaleHasProduct pdvHasProduct
            LEFT JOIN pdvHasProduct.product product
            WHERE
            product.id = :productId
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('productId', $productId);

        return $query->getResult();
    }

}
