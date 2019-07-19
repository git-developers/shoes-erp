<?php

declare(strict_types=1);

namespace Component\Image\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface ImageAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return ImageAssociationTypeInterface|null
     */
    public function getType(): ?ImageAssociationTypeInterface;

    /**
     * @param ImageAssociationTypeInterface|null $type
     */
    public function setType(?ImageAssociationTypeInterface $type): void;

    /**
     * @return ImageInterface|null
     */
    public function getOwner(): ?ImageInterface;

    /**
     * @param ImageInterface|null $owner
     */
    public function setOwner(?ImageInterface $owner): void;

    /**
     * @return Collection|ImageInterface[]
     */
    public function getAssociatedImages(): Collection;

    /**
     * @param ImageInterface $Image
     */
    public function addAssociatedImage(ImageInterface $Image): void;

    /**
     * @param ImageInterface $Image
     */
    public function removeAssociatedImage(ImageInterface $Image): void;

    /**
     * @param ImageInterface $Image
     *
     * @return bool
     */
    public function hasAssociatedImage(ImageInterface $Image): bool;

    public function clearAssociatedImages(): void;
}
