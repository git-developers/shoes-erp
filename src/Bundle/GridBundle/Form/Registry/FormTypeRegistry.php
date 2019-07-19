<?php

declare(strict_types=1);

namespace Bundle\GridBundle\Form\Registry;

final class FormTypeRegistry implements FormTypeRegistryInterface
{
    /**
     * @var array
     */
    private $formTypes = [];

    /**
     * {@inheritdoc}
     */
    public function add(string $identifier, string $typeIdentifier, string $formType)
    {
        $this->formTypes[$identifier][$typeIdentifier] = $formType;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $identifier, string $typeIdentifier)
    {
        if (!$this->has($identifier, $typeIdentifier)) {
            return null;
        }

        return $this->formTypes[$identifier][$typeIdentifier];
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $identifier, string $typeIdentifier)
    {
        return isset($this->formTypes[$identifier][$typeIdentifier]);
    }
}
