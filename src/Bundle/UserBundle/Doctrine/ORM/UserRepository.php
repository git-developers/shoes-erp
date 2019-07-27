<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Doctrine\ORM;

use Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Component\User\Model\UserInterface;
use Component\User\Repository\UserRepositoryInterface;
use Component\OneToMany\Repository\OneToManyLeftRepositoryInterface;
use Bundle\ProfileBundle\Entity\Profile;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
	
	/**
	 * {@inheritdoc}
	 */
	public function findAllByIds(array $ids): array
	{
		$em = $this->getEntityManager();
		$dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.enabled = :active AND
            user_.id IN (:ids)
            ";
		
		$query = $em->createQuery($dql);
		$query->setParameter('active', 1);
		$query->setParameter('ids', $ids);
		
		return $query->getResult();
	}

    /**
     * {@inheritdoc}
     */
    public function findOneById(int $id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.enabled = :active AND
            user_.id = :id
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBySlug(string $slug)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.enabled = :active AND
            user_.slug = :slug
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('slug', $slug);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByUsername(string $username)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.enabled = :active AND
            user_.username = :username
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('username', $username);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllOffsetLimit($offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.enabled = :active
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
            ->where('a.enabled = :active')
            ->andWhere('a.isActive = :active')
            ->orderBy('a.id', 'ASC')
            ->setParameter('active', true)
            ;
    }
	
//	/**
//	 * {@inheritdoc}
//	 */
//	public function findAllClient($idPdv) //: array
//	{
//		$em = $this->getEntityManager();
//		$dql = "
//            SELECT pdv, user_, profile
//            FROM PointofsaleBundle:Pointofsale pdv
//            LEFT JOIN pdv.user user_
//            INNER JOIN user_.profile profile
//            WHERE
//            pdv.id = :id AND
//            profile.slug = :slug AND
//            pdv.isActive = :active
//            ";
//
//		$query = $em->createQuery($dql);
//		$query->setParameter('active', 1);
//		$query->setParameter('id', $idPdv);
//		$query->setParameter('slug', Profile::CLIENT_SLUG);
//
//		return $query->getOneOrNullResult();
//	}
    
    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
	    $em = $this->getEntityManager();
        
	    $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            user_.enabled = :active
            ";

	    //AND user_.isActive = :active
	    
        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        
	    return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllClient() //: array
    {
	    $em = $this->getEntityManager();
	    $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            profile.slug = :slug AND
            user_.enabled = :active
            ";
	
	    $query = $em->createQuery($dql);
	    $query->setParameter('active', 1);
	    $query->setParameter('slug', Profile::CLIENT_SLUG);

	    return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllEmployee() //: array
    {
	    $em = $this->getEntityManager();
	    $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            profile.slug = :slug AND
            user_.enabled = :active
            ";
	
	    $query = $em->createQuery($dql);
	    $query->setParameter('active', 1);
	    $query->setParameter('slug', Profile::EMPLOYEE_SLUG);
	
	    return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllEmployeeCOPY($idPdv) //: array
    {
	    $em = $this->getEntityManager();
	    $dql = "
            SELECT pdv, user_, profile
            FROM PointofsaleBundle:Pointofsale pdv
            LEFT JOIN pdv.user user_
            INNER JOIN user_.profile profile
            WHERE
            pdv.id = :id AND
            profile.slug = :slug AND
            pdv.isActive = :active
            ";
	
	    $query = $em->createQuery($dql);
	    $query->setParameter('active', 1);
	    $query->setParameter('id', $idPdv);
	    $query->setParameter('slug', Profile::EMPLOYEE_SLUG);
	
	    return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByEmail(string $email)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.emailCanonical = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByEmail2(string $email)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.email = :email AND
            user_.enabled = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('email', $email);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByUniqid(string $uniqid)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.resetPasswordHash = :uniqid AND
            SUBSTRING(user_.resetPasswordDate, 1, 10) = :resetDate AND
            user_.enabled = :active
            ";

        $resetDate = new \DateTime();
        $resetDate = $resetDate->format('Y-m-d');

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('uniqid', $uniqid);
        $query->setParameter('resetDate', $resetDate);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function oneToManyLeft($leftValue)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.id = :id AND
            user_.enabled = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $leftValue);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function searchBoxRight($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            ( user_.name LIKE :q OR user_.lastName LIKE :q ) AND
            user_.enabled = :active
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
    public function searchBoxLeft($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            ( user_.name LIKE :q OR user_.lastName LIKE :q ) AND
            user_.enabled = :active
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
    public function deleteAssociativeTableById($id): bool
    {
//        return $em->getConnection()
//            ->prepare('DELETE FROM profile_has_role WHERE profile_id = :id;')
//            ->bindValue('id', $id)
//            ->execute()
//            ;

        $em = $this->getEntityManager();
        $sql = "DELETE FROM user_has_route WHERE user_id = :id;";
        $params = array('id' => $id);

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        // puesto provisional
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function login(\stdClass $data)
    {
        $username = strtolower($data->username);

        $em = $this->getEntityManager();
        $dql = '
            SELECT UserTianos
            FROM UserBundle:User UserTianos
            WHERE
            (LOWER(UserTianos.email) = :email OR LOWER(UserTianos.username) = :username) AND
            UserTianos.enabled = :active
        ';

        return $em->createQuery($dql)
            ->setParameter('active', 1)
            ->setParameter('email', $username)
            ->setParameter('username', $username)
            ->getOneOrNullResult()
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function findRouteByUsername($username)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_, route
            FROM UserBundle:User user_
            LEFT JOIN user_.route route
            WHERE
            user_.enabled = :active AND
            user_.username = :username
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('username', $username);

        return $query->getOneOrNullResult();
    }

}
