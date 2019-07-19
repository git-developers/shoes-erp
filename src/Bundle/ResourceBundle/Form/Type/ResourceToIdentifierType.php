<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Form\Type;

use Bundle\ResourceBundle\Form\DataTransformer\ResourceToIdentifierTransformer;
use Component\Resource\Metadata\MetadataInterface;
use Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ResourceToIdentifierType extends AbstractType
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var MetadataInterface
     */
    private $metadata;

    /**
     * @param RepositoryInterface $repository
     * @param MetadataInterface $metadata
     */
    public function __construct(RepositoryInterface $repository, MetadataInterface $metadata)
    {
        $this->repository = $repository;
        $this->metadata = $metadata;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(
            new ResourceToIdentifierTransformer($this->repository, $options['identifier'])
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'identifier' => 'id',
            ])
            ->setAllowedTypes('identifier', 'string')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return EntityType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return sprintf('%s_%s_to_identifier', $this->metadata->getApplicationName(), $this->metadata->getName());
    }
}
