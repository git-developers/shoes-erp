<?php

declare(strict_types=1);

namespace Component\Pdvhasproduct\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;
use Component\Resource\Model\TranslatableTrait;
use Component\Resource\Model\TranslationInterface;

class PdvhasproductVariant implements PdvhasproductVariantInterface
{
    use TimestampableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
        getTranslation as private doGetTranslation;
    }

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var PdvhasproductInterface
     */
    protected $Pdvhasproduct;

    /**
     * @var Collection|PdvhasproductOptionValueInterface[]
     */
    protected $optionValues;

    /**
     * @var int
     */
    protected $position;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->optionValues = new ArrayCollection();

        $this->createdAt = new \DateTime();
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
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->getTranslation()->setName($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getDescriptor(): string
    {
        $name = empty($this->getName()) ? $this->getPdvhasproduct()->getName() : $this->getName();

        return trim(sprintf('%s (%s)', $name, $this->code));
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionValues(): Collection
    {
        return $this->optionValues;
    }

    /**
     * {@inheritdoc}
     */
    public function addOptionValue(PdvhasproductOptionValueInterface $optionValue): void
    {
        if (!$this->hasOptionValue($optionValue)) {
            $this->optionValues->add($optionValue);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeOptionValue(PdvhasproductOptionValueInterface $optionValue): void
    {
        if ($this->hasOptionValue($optionValue)) {
            $this->optionValues->removeElement($optionValue);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasOptionValue(PdvhasproductOptionValueInterface $optionValue): bool
    {
        return $this->optionValues->contains($optionValue);
    }

    /**
     * {@inheritdoc}
     */
    public function getPdvhasproduct(): ?PdvhasproductInterface
    {
        return $this->Pdvhasproduct;
    }

    /**
     * {@inheritdoc}
     */
    public function setPdvhasproduct(?PdvhasproductInterface $Pdvhasproduct): void
    {
        $this->Pdvhasproduct = $Pdvhasproduct;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }

    /**
     * @param string|null $locale
     *
     * @return PdvhasproductVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var PdvhasproductVariantTranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): PdvhasproductVariantTranslationInterface
    {
        return new PdvhasproductVariantTranslation();
    }
}
