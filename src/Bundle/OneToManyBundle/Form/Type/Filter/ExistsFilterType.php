<?php

declare(strict_types=1);

namespace Bundle\OneToManyBundle\Form\Type\Filter;

use Component\OneToMany\Filter\ExistsFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ExistsFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choices' => [
                    'sylius.ui.no_label' => ExistsFilter::FALSE,
                    'sylius.ui.yes_label' => ExistsFilter::TRUE,
                ],
                'choice_values' => [
                    ExistsFilter::FALSE,
                    ExistsFilter::TRUE,
                ],
                'data_class' => null,
                'required' => false,
                'placeholder' => false,
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
        return 'sylius_grid_filter_exists';
    }
}
