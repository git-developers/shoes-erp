<?php

declare(strict_types=1);

namespace Bundle\SettingsBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Settings\Repository\SettingsRepositoryInterface;

class SettingsRepository extends TianosEntityRepository implements SettingsRepositoryInterface
{
	
	/**
	 * {@inheritdoc}
	 */
	public function deleteAll(): bool
	{
		$em = $this->getEntityManager();
		
        return $em->getConnection()
            ->prepare('DELETE FROM settings;')
            ->execute()
            ;
		
		return true;
	}

    /**
     * {@inheritdoc}
     */
    public function findOneLast()
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT settings
            FROM SettingsBundle:Settings settings
            WHERE
            settings.isActive = :active
            ORDER BY settings.id DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setMaxResults(1);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT settings
            FROM SettingsBundle:Settings settings
            WHERE
            settings.id = :id AND
            settings.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findByClassName($className)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT settings.classValue
            FROM SettingsBundle:Settings settings
            WHERE
            settings.className = :className AND
            settings.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('className', $className);
        
        return $query->getSingleScalarResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT settings
            FROM SettingsBundle:Settings settings
            WHERE
            settings.isActive = :active
            ORDER BY settings.id ASC
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
}
