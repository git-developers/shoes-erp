<?php

declare(strict_types=1);

namespace Bundle\ProfileBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Profile\Repository\ProfileRepositoryInterface;
use Component\OneToMany\Repository\OneToManyLeftRepositoryInterface;
use Bundle\ProfileBundle\Entity\Profile;

class ProfileRepository extends TianosEntityRepository implements ProfileRepositoryInterface, OneToManyLeftRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function deleteAssociativeTableById($id): bool
    {

        $em = $this->getEntityManager();

//        return $em->getConnection()
//            ->prepare('DELETE FROM profile_has_role WHERE profile_id = :id;')
//            ->bindValue('id', $id)
//            ->execute()
//            ;

        $sql = "DELETE FROM profile_has_role WHERE profile_id = :id;";
        $params = array('id' => $id);

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        // puesto provisional
        return true;

    }

    /**
     * {@inheritdoc}
     */
    public function oneToManyLeft($leftValue)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.id = :id AND
            profile.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $leftValue);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.id = :id AND
            profile.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findProfilesBySlugs(array $slugs)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.slug IN (:slugs) AND
            profile.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('slugs', $slugs);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function searchBoxLeft($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.name LIKE :q AND
            profile.isActive = :active
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
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

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
	public function findAllObjects()
	{
		return $this->createQueryBuilder('a')
			->where('a.isActive = :active')
//			->andWhere('a.slug IN (:slugs)')
			->orderBy('a.id', 'ASC')
			->setParameter('active', true)
//			->setParameter('slugs', [
//				Profile::PDV_ADMIN_SLUG,
//				Profile::EMPLOYEE_SLUG,
//				Profile::CLIENT_SLUG
//			])
			;
	}
 
	/**
	 * {@inheritdoc}
	 */
	public function findAllObjectsClient()
	{
		return $this->createQueryBuilder('a')
			->where('a.isActive = :active')
			->andWhere('a.slug IN (:slugs)')
			->orderBy('a.id', 'ASC')
			->setParameter('active', true)
			->setParameter('slugs', [
				Profile::CLIENT_SLUG
			])
			;
	}
 
	/**
	 * {@inheritdoc}
	 */
	public function findAllObjectsEmployee()
	{
		return $this->createQueryBuilder('a')
			->where('a.isActive = :active')
			->andWhere('a.slug IN (:slugs)')
			->orderBy('a.id', 'ASC')
			->setParameter('active', true)
			->setParameter('slugs', [
				Profile::EMPLOYEE_SLUG
			])
			;
	}

//    /**
//     * {@inheritdoc}
//     */
//    public function find($id)
//    {
//        return $this->createQueryBuilder('o')
//            ->select('o.id, o.code, o.name, o.createdAt')
//            ->andWhere('o.isActive = :active')
//            ->andWhere('o.id = :id')
//            ->setParameter('active', 1)
//            ->setParameter('id', $id)
//            ->getQuery()
//            ->getOneOrNullResult()
//            ;
//    }
}
