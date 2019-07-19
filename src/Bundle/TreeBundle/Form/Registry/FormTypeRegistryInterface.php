<?php

declare(strict_types=1);

namespace Bundle\TreeBundle\Form\Registry;

interface FormTypeRegistryInterface
{
    /**
     * @param string $identifier
     * @param string $typeIdentifier
     * @param string $formType
     */
    public function add(string $identifier, string $typeIdentifier, string $formType);

    /**
     * @param string $identifier
     * @param string $typeIdentifier
     *
     * @return string|null
     */
    public function get(string $identifier, string $typeIdentifier);

    /**
     * @param string $identifier
     * @param string $typeIdentifier
     *
     * @return bool
     */
    public function has(string $identifier, string $typeIdentifier);
}
