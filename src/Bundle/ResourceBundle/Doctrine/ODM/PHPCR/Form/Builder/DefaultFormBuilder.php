<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bundle\ResourceBundle\Doctrine\ODM\PHPCR\Form\Builder;

use Doctrine\ODM\PHPCR\DocumentManagerInterface;
use Bundle\ResourceBundle\Form\Builder\DefaultFormBuilderInterface;
use Component\Resource\Metadata\MetadataInterface;
use Symfony\Component\Form\FormBuilderInterface;

class DefaultFormBuilder implements DefaultFormBuilderInterface
{
    /**
     * @var DocumentManagerInterface
     */
    private $documentManager;

    /**
     * @param DocumentManagerInterface $documentManager
     */
    public function __construct(
        DocumentManagerInterface $documentManager
    ) {
        $this->documentManager = $documentManager;
    }

    /**
     * {@inheritdoc}
     */
    public function build(MetadataInterface $metadata, FormBuilderInterface $formBuilder, array $options): void
    {
        $classMetadata = $this->documentManager->getClassMetadata($metadata->getClass('model'));

        // the field mappings should only contain standard value mappings
        foreach ($classMetadata->fieldMappings as $fieldName) {
            if ($fieldName === $classMetadata->uuidFieldName) {
                continue;
            }
            if ($fieldName === $classMetadata->nodename) {
                continue;
            }

            $options = [];

            $mapping = $classMetadata->mappings[$fieldName];

            if ($mapping['nullable'] === false) {
                $options['required'] = true;
            }

            $formBuilder->add($fieldName, null, $options);
        }
    }
}
