<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Bundle\UserBundle\Entity\User;
use Component\Pointofsale\Repository\PointofsaleRepositoryInterface;
use Component\OneToMany\Repository\OneToManyLeftRepositoryInterface;
use Component\OneToMany\Repository\OneToManyRightRepositoryInterface;

class PointofsaleRepository extends TianosEntityRepository implements
    PointofsaleRepositoryInterface,
	OneToManyLeftRepositoryInterface,
	OneToManyRightRepositoryInterface
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
        $sql = "DELETE FROM point_of_sale_has_user WHERE point_of_sale_id = :id;";
        $params = ['id' => $id];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        // puesto provisional
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function searchBoxLeft($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.name LIKE :q AND
            pointofsale.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('q', '%' . $q . '%');
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllOffsetLimit($offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

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

    public function findAllObjectsByPdv($pdv)
    {
        return $this->createQueryBuilder('a')
            ->where('a.isActive = :active')
            ->andWhere('a.pointOfSale = :pointOfSale')
            ->orWhere('a.id = :pointOfSale')
            ->orderBy('a.id', 'ASC')
            ->setParameter('active', true)
            ->setParameter('pointOfSale', $pdv->getId())
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function oneToManyLeft($leftValue)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.id = :id AND
            pointofsale.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $leftValue);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findBySlug($slug)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.slug = :slug AND
            pointofsale.isActive = :active
            ";
        
        // pointofsale.pointOfSale IS NULL AND

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('slug', $slug);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pdv
            FROM PointofsaleBundle:Pointofsale pdv
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
    public function findByPDV($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pdv, user_
            FROM PointofsaleBundle:Pointofsale pdv
            LEFT JOIN pdv.user user_
            WHERE
            pdv.id = :id AND
            pdv.isActive = :active AND
            user_.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findParentAndChildren($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pdv
            FROM PointofsaleBundle:Pointofsale pdv
            WHERE
            pdv.id = :id AND
            pdv.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        $pdv = $query->getOneOrNullResult();

        if (!is_null($pdv)) {
            $pdvs = $this->findAllChildrenByParent($pdv->getId());
            $pdv->setPointOfSaleChildren($pdvs);
        }

        return $pdv;
    }

    /**
     * {@inheritdoc}
     */
    public function findAllPerUser(User $user): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.isActive = :active AND
            pointofsale.id IN (:ids)
            ";

        $ids = [];
        $pointOfSales = $user->getPointOfSale();

        foreach ($pointOfSales as $key => $pointOfSale) {
            $ids[] = $pointOfSale->getId();
        }

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('ids', $ids);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllParents(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.isActive = :active AND
            pointofsale.pointOfSale IS NULL
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllChildrenByParent($idParent): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.isActive = :active AND
            pointofsale.pointOfSale = :idParent
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('idParent', $idParent);

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
    public function searchBoxRight($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.name LIKE :q AND
            pointofsale.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('q', '%' . $q . '%');
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

}
