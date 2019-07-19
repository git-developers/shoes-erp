<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Doctrine\ORM;

use Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Component\User\Model\UserInterface;
use Component\User\Repository\UserRepositoryInterface;
use Component\OneToMany\Repository\OneToManyLeftRepositoryInterface;
use Bundle\ProfileBundle\Entity\Profile;

class FriendsRepository extends EntityRepository implements UserRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function findOneByUsername(string $username, int $friendId)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT friends, user_, friend_
            FROM UserBundle:Friends friends
            INNER JOIN friends.user user_
            LEFT JOIN friends.friend friend_
            WHERE
            user_.username = :username AND
            user_.enabled = :active AND
            friend_.id = :friendId AND
            friend_.enabled = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('username', $username);
        $query->setParameter('friendId', $friendId);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllFriends($userId): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT friends, friend
            FROM UserBundle:Friends friends
            INNER JOIN friends.friend friend
            WHERE
            friend.id = :userId AND
            friend.enabled = :active
            ";
//        $dql = "
//            SELECT friends, friend
//            FROM UserBundle:Friends friends
//            INNER JOIN friends.friend friend
//            WHERE
//            friend.id = :userId AND
//            friend.enabled = :active
//            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('userId', $userId);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function isFriend(string $username, int $friendId): bool
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT friends, user_, friend_
            FROM UserBundle:Friends friends
            INNER JOIN friends.user user_
            LEFT JOIN friends.friend friend_
            WHERE
            user_.username = :username AND
            user_.enabled = :active AND
            friend_.id = :friendId AND
            friend_.enabled = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('username', $username);
        $query->setParameter('friendId', $friendId);

        if ($query->getOneOrNullResult()) {
            return true;
        }

        return false;
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
            ->orderBy('a.id', 'ASC')
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
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            user_.enabled = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
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

}
