<?php

declare(strict_types=1);

namespace Component\Route\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class RouteAssociation implements RouteAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var RouteAssociationTypeInterface
     */
    protected $type;

    /**
     * @var RouteInterface
     */
    protected $owner;

    /**
     * @var Collection|RouteInterface[]
     */
    protected $associatedRoutes;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedRoutes = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ?RouteAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?RouteAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?RouteInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?RouteInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedRoutes(): Collection
    {
        return $this->associatedRoutes;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedRoute(RouteInterface $Route): bool
    {
        return $this->associatedRoutes->contains($Route);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedRoute(RouteInterface $Route): void
    {
        if (!$this->hasAssociatedRoute($Route)) {
            $this->associatedRoutes->add($Route);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedRoute(RouteInterface $Route): void
    {
        if ($this->hasAssociatedRoute($Route)) {
            $this->associatedRoutes->removeElement($Route);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedRoutes(): void
    {
        $this->associatedRoutes->clear();
    }
}
