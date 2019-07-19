<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Google\Repository\GoogleRepositoryInterface;

class GoogleDriveFileRepository extends TianosEntityRepository implements GoogleRepositoryInterface
{


    /**
     * {@inheritdoc}
     */
    public function relevance($id, $fileName): array
    {
        $em = $this->getEntityManager();
        $sql = "SELECT 
                    CONCAT(t2.name, ' ', t2.last_name) AS user_name,
                    t2.slug AS user_slug,
                    t1.slug,
                    t1.file_id,
                    t1.file_name,
                    t1.has_thumbnail,
                    t1.count_share,
                    t1.count_view
                FROM google_drive_file AS t1
                INNER JOIN user AS t2 on t2.id = t1.user_id
                WHERE 
                    t2.id <> :id AND
                    t2.is_active = :active
                ORDER BY RAND()
                LIMIT 20
                ;
                ";

        $params = [
            'id' => $id,
            'active' => 1,
//            'fileName' => '%' . $fileName . '%'
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllNative(): array
    {
        $em = $this->getEntityManager();
        $sql = "SELECT 
                    id, 
                    slug, 
                    file_name,
                    file_icon_link
                FROM google_drive_file 
                WHERE is_active = :active
                ORDER BY id DESC
                ;
                ";
        $params = ['active' => 1];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findMisArchivos($userId): array
    {
        $em = $this->getEntityManager();
        $sql = "SELECT 
                    id, 
                    slug, 
                    file_icon_link, 
                    file_name, 
                    file_size 
                FROM google_drive_file 
                WHERE 
                    is_active = :active AND
                    user_id = :userId
                ORDER BY id DESC
                ;
                ";
        $params = [
            'active' => 1,
            'userId' => $userId,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google
            FROM GoogleBundle:GoogleDriveFile google
            WHERE
            google.id = :id AND
            google.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll($maxResults = 30): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google
            FROM GoogleBundle:GoogleDriveFile google
            WHERE
            google.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setMaxResults($maxResults);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllNotHasThumbnail($maxResults = 10): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google
            FROM GoogleBundle:GoogleDriveFile google
            WHERE
            google.isActive = :active AND
            google.hasThumbnail = :hasThumbnail AND
            ( SUBSTRING(google.updatedAt, 1, 10) = :yesterday OR google.updatedAt IS NULL )
            ";

        $date = new \DateTime('yesterday');
        $yesterday = $date->format('Y-m-d');

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('hasThumbnail', 0);
        $query->setParameter('yesterday', $yesterday);
        $query->setMaxResults($maxResults);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllHasThumbnail($maxResults = 30)
    {
        $em = $this->getEntityManager();
        $sql = "SELECT 
                    CONCAT(t2.name, ' ', t2.last_name) AS user_name,
                    t2.slug AS user_slug,
                    t1.slug,
                    t1.file_id,
                    t1.file_name,
                    t1.file_icon_link,
                    t1.created_at,
                    t1.has_thumbnail,
                    t1.count_share,
                    t1.count_view
                FROM google_drive_file AS t1
                INNER JOIN user AS t2 on t2.id = t1.user_id
                WHERE 
                    t1.has_thumbnail = :hasThumbnail AND
                    t1.is_active = :active
                ORDER BY RAND()
                LIMIT 30
                ;
                ";

        $params = [
            'hasThumbnail' => 1,
            'active' => 1,
//            'maxResults' => $maxResults,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * {@inheritdoc}
     */
    public function lastFiles($userId = null)
    {
        $em = $this->getEntityManager();
        $sql = "SELECT 
                    t1.slug,
                    t1.file_id,
                    t1.file_name,
                    t1.file_icon_link,
                    t1.created_at,
                    t1.has_thumbnail,
                    t1.description,
                    t1.count_share,
                    t1.count_view
                FROM google_drive_file AS t1
                WHERE 
                    t1.user_id = :userId AND
                    t1.is_active = :active
                ORDER BY t1.id DESC
                LIMIT 7
                ;
                ";

        $params = [
            'active' => 1,
            'userId' => $userId,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
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
