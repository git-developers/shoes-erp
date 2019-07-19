<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Google\Repository\GoogleRepositoryInterface;

class GoogleDriveFileVoteRepository extends TianosEntityRepository implements GoogleRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function vote($userId, $googleDriveId, $vote): bool
    {
        /**
         * DELETE
         */
        $em = $this->getEntityManager();
        $sql = "DELETE FROM google_drive_file_vote WHERE user_id = :userId AND google_drive_file_id = :googleDriveId;";
        $params = [
            'userId' => $userId,
            'googleDriveId' => $googleDriveId,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);


        /**
         * INSERT
         */
        $datetime = new \DateTime("now");
        $now = $datetime->format('Y-m-d H:i:s');

        $em = $this->getEntityManager();
        $sql = "INSERT INTO google_drive_file_vote (user_id, google_drive_file_id, vote, created_at) VALUES (:userId, :googleDriveId, :vote, :now);";
        $params = [
            'userId' => $userId,
            'googleDriveId' => $googleDriveId,
            'vote' => $vote,
            'now' => $now,
        ];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        // puesto provisional
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google
            FROM GoogleBundle:GoogleDriveFileVote google
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
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google
            FROM GoogleBundle:GoogleDriveFileVote google
            WHERE
            google.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();

//        return $this->createQueryBuilder('o')
//            ->select('o.id, o.code, o.name, o.createdAt')
//            ->andWhere('o.isActive = :active')
//            ->setParameter('active', 1)
//            ->getQuery()
//            ->getResult()
//            ;
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
