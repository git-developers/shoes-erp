<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Google\Repository\GoogleRepositoryInterface;

class GoogleDriveFileCountRepository extends TianosEntityRepository
{

    /**
     * {@inheritdoc}
     */
    public function insertShare($fileId)
    {
        $em = $this->getEntityManager();
        $sql = "INSERT INTO google_drive_file_count (file_id, count_share) VALUES (:fileId, :countShare);";

        $params = [
            'fileId' => $fileId,
            'countShare' => 1,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * {@inheritdoc}
     */
    public function insertView($fileId)
    {
        $em = $this->getEntityManager();
        $sql = "INSERT INTO google_drive_file_count (file_id, count_view) VALUES (:fileId, :countView);";

        $params = [
            'fileId' => $fileId,
            'countView' => 1,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google
            FROM GoogleBundle:GoogleDriveFileCount google
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
    public function getViewCount(): array
    {
        $em = $this->getEntityManager();
        $sql = "SELECT 
                  COUNT(id) AS count_, 
                  file_id,
                  count_view
                FROM 
                  google_drive_file_count
                WHERE
                  count_view = :countView  
                GROUP BY file_id LIMIT 10;";

        $params = [
            'countView' => 1,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getShareCount(): array
    {
        $em = $this->getEntityManager();
        $sql = "SELECT 
                  COUNT(id) AS count_, 
                  file_id,
                  count_share
                FROM 
                  google_drive_file_count
                WHERE
                  count_share = :countShare  
                GROUP BY file_id LIMIT 10;";

        $params = [
            'countShare' => 1,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteViewCount($fileId)
    {
        $em = $this->getEntityManager();
        $sql = "DELETE 
                FROM 
                    google_drive_file_count 
                WHERE 
                    file_id = :fileId AND 
                    count_view = :countView 
                ;";

        $params = [
            'fileId' => $fileId,
            'countView' => 1,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteShareCount($fileId)
    {
        $em = $this->getEntityManager();
        $sql = "DELETE 
                FROM 
                    google_drive_file_count 
                WHERE 
                    file_id = :fileId AND 
                    count_share = :countShare 
                ;";

        $params = [
            'fileId' => $fileId,
            'countShare' => 1,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);
    }

}
