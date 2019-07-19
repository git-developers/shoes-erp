<?php

declare(strict_types=1);

namespace Component\Pdvhasproduct\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface PdvhasproductAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return PdvhasproductAssociationTypeInterface|null
     */
    public function getType(): ?PdvhasproductAssociationTypeInterface;

    /**
     * @param PdvhasproductAssociationTypeInterface|null $type
     */
    public function setType(?PdvhasproductAssociationTypeInterface $type): void;

    /**
     * @return PdvhasproductInterface|null
     */
    public function getOwner(): ?PdvhasproductInterface;

    /**
     * @param PdvhasproductInterface|null $owner
     */
    public function setOwner(?PdvhasproductInterface $owner): void;

    /**
     * @return Collection|PdvhasproductInterface[]
     */
    public function getAssociatedPdvhasproducts(): Collection;

    /**
     * @param PdvhasproductInterface $Pdvhasproduct
     */
    public function addAssociatedPdvhasproduct(PdvhasproductInterface $Pdvhasproduct): void;

    /**
     * @param PdvhasproductInterface $Pdvhasproduct
     */
    public function removeAssociatedPdvhasproduct(PdvhasproductInterface $Pdvhasproduct): void;

    /**
     * @param PdvhasproductInterface $Pdvhasproduct
     *
     * @return bool
     */
    public function hasAssociatedPdvhasproduct(PdvhasproductInterface $Pdvhasproduct): bool;

    public function clearAssociatedPdvhasproducts(): void;
}
