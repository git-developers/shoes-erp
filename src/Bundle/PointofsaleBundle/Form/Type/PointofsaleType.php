<?php

namespace Bundle\PointofsaleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

class PointofsaleType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $data = [];
        if (isset($options['form_data']['pdv_parent'])) {
            $data = ['data' => $options['form_data']['pdv_parent']];
        }

        $builder
            ->add('pointOfSale', EntityType::class, array_merge(
                [
                    'class' => Pointofsale::class,
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findAllObjects();
                    },
                    'placeholder' => '[ Escoja una opción ]',
                    'empty_data' => null,
                    'required' => false,
                    'label' => 'Punto de venta padre',
                    'label_attr' => [
                        'class' => ''
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => '',
                    ],
                ],
                $data
            ))
            ->add('code', TextType::class, [
                'label' => 'Codigo',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control random',
                    'placeholder' => 'code',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('address', TextType::class, [
                'label' => 'Direccion',
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'direccion',
                ],
            ])
            ->add('latitude', TextType::class, [
                'label' => 'latitude',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control latitude',
                    'placeholder' => '00.00',
	                'readonly' => 'readonly',
                ],
            ])
            ->add('longitude', TextType::class, [
                'label' => 'longitude',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control longitude',
                    'placeholder' => '00.00',
                    'readonly' => 'readonly',
                ],
            ])
            ->add('slug', TextType::class, [
                'label' => 'slug',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'slug',
                ],
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Pointofsale::class,
        ]);

        $resolver->setRequired([
            'form_data',
        ]);
    }

}
