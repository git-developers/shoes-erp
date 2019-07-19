<?php

declare(strict_types=1);

namespace Bundle\TreeOneToManyBundle\Form\Type\Filter;

use Component\OneToMany\Filter\BooleanFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class BooleanFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choices' => [
                    'sylius.ui.yes_label' => BooleanFilter::TRUE,
                    'sylius.ui.no_label' => BooleanFilter::FALSE,
                ],
                'data_class' => null,
                'required' => false,
                'placeholder' => 'sylius.ui.all',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return ChoiceType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_grid_filter_boolean';
    }
}
