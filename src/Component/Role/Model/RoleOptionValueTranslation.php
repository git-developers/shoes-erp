<?php

declare(strict_types=1);

namespace Component\Role\Model;

use Component\Resource\Model\AbstractTranslation;

class RoleOptionValueTranslation extends AbstractTranslation implements RoleOptionValueTranslationInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $value;

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
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
    }
}
