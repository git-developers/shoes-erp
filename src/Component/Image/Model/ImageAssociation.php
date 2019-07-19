<?php

declare(strict_types=1);

namespace Component\Image\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class ImageAssociation implements ImageAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var ImageAssociationTypeInterface
     */
    protected $type;

    /**
     * @var ImageInterface
     */
    protected $owner;

    /**
     * @var Collection|ImageInterface[]
     */
    protected $associatedImages;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedImages = new ArrayCollection();
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
    public function getType(): ?ImageAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?ImageAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?ImageInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?ImageInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedImages(): Collection
    {
        return $this->associatedImages;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedImage(ImageInterface $Image): bool
    {
        return $this->associatedImages->contains($Image);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedImage(ImageInterface $Image): void
    {
        if (!$this->hasAssociatedImage($Image)) {
            $this->associatedImages->add($Image);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedImage(ImageInterface $Image): void
    {
        if ($this->hasAssociatedImage($Image)) {
            $this->associatedImages->removeElement($Image);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedImages(): void
    {
        $this->associatedImages->clear();
    }
}
