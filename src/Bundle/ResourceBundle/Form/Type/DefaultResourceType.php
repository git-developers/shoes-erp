<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Form\Type;

use Component\Registry\ServiceRegistryInterface;
use Component\Resource\Metadata\RegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

final class DefaultResourceType extends AbstractType
{
    /**
     * @var RegistryInterface
     */
    private $metadataRegistry;

    /**
     * @var ServiceRegistryInterface
     */
    private $formBuilderRegistry;

    /**
     * @param RegistryInterface $metadataRegistry
     * @param ServiceRegistryInterface $formBuilderRegistry
     */
    public function __construct(RegistryInterface $metadataRegistry, ServiceRegistryInterface $formBuilderRegistry)
    {
        $this->metadataRegistry = $metadataRegistry;
        $this->formBuilderRegistry = $formBuilderRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $metadata = $this->metadataRegistry->getByClass($options['data_class']);
        $formBuilder = $this->formBuilderRegistry->get($metadata->getDriver());

        $formBuilder->build($metadata, $builder, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_resource';
    }
}
