<?php

declare(strict_types=1);

namespace Component\Pdvhasproduct\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class PdvhasproductAssociation implements PdvhasproductAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var PdvhasproductAssociationTypeInterface
     */
    protected $type;

    /**
     * @var PdvhasproductInterface
     */
    protected $owner;

    /**
     * @var Collection|PdvhasproductInterface[]
     */
    protected $associatedPdvhasproducts;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedPdvhasproducts = new ArrayCollection();
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
    public function getType(): ?PdvhasproductAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?PdvhasproductAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?PdvhasproductInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?PdvhasproductInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedPdvhasproducts(): Collection
    {
        return $this->associatedPdvhasproducts;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedPdvhasproduct(PdvhasproductInterface $Pdvhasproduct): bool
    {
        return $this->associatedPdvhasproducts->contains($Pdvhasproduct);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedPdvhasproduct(PdvhasproductInterface $Pdvhasproduct): void
    {
        if (!$this->hasAssociatedPdvhasproduct($Pdvhasproduct)) {
            $this->associatedPdvhasproducts->add($Pdvhasproduct);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedPdvhasproduct(PdvhasproductInterface $Pdvhasproduct): void
    {
        if ($this->hasAssociatedPdvhasproduct($Pdvhasproduct)) {
            $this->associatedPdvhasproducts->removeElement($Pdvhasproduct);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedPdvhasproducts(): void
    {
        $this->associatedPdvhasproducts->clear();
    }
}
