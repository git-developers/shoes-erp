<?php

namespace Bundle\PointofsaleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

class PointofsaleOpening2Type extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
	        ->add('pointOfSale', EntityType::class, [
		        'class' => Pointofsale::class,
		        'query_builder' => function(EntityRepository $er) {
			        return $er->findAllObjects();
		        },
		        'placeholder' => '[ Seleccione un punto de venta ]',
		        'empty_data' => null,
		        'required' => true,
		        'label' => 'Punto de venta',
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control',
			        'placeholder' => '',
		        ],
	        ])
            ->add('openingDate', DateType::class, [
                'label' =>' Fecha de apertura',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'html5' => true,
                'widget' => 'single_text',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Refrescar',
                'attr' => [
                    'class' => 'btn btn-primary',
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
//            'data_class' => Report::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
