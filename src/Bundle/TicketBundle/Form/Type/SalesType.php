<?php

namespace Bundle\TicketBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bundle\UserBundle\Entity\User;
use Bundle\TicketBundle\Entity\PaymentType;
use Bundle\TicketBundle\Entity\Sales;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SalesType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	        ->add('deliveryDate', DateType::class , [
		        'label' => 'Fecha de entrega',
		        'required' => false,
		        'widget' => 'single_text',
		        'label_attr' => [
			        'class' => ''
		        ],
//                'format' => 'dd-MM-yyyy',
//                'years' => range(date('Y') -18, date('Y') -80),
//                'placeholder' => array(
//                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
//                ),
		        'attr' => [
			        'class' => 'form-control',
			        'title'=>'',
		        ],
		        'error_bubbling' => true
	        ])
            ->add('name', TextType::class, [
                'label' => 'Referencia',
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'descripción',
                ],
            ])
	        ->add('discount', HiddenType::class, [
		        'label' => false,
		        'required' => false,
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => '',
			        'placeholder' => '',
		        ],
	        ])
	        ->add('payment', HiddenType::class, [
		        'label' => false,
		        'required' => false,
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => '',
			        'placeholder' => '',
		        ],
	        ])
	        ->add('client', EntityType::class, array(
		        'class' => User::class,
		        'query_builder' => function(EntityRepository $er) {
			        return $er->findAllObjects();
		        },
		        'placeholder' => '[ Escoge un cliente ]',
		        'empty_data' => null,
		        'required' => false,
		        'label' => 'Cliente',
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control hide',
			        'placeholder' => '',
		        ],
	        ))
	        ->add('paymentType', EntityType::class, array(
		        'class' => PaymentType::class,
		        'query_builder' => function(EntityRepository $er) {
			        return $er->findAllObjects();
		        },
		        'placeholder' => '[ Escoge forma de pago ]',
		        'empty_data' => null,
		        'required' => false,
		        'label' => 'Forma de pago',
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control',
			        'placeholder' => '',
		        ],
	        ))
	        ->add('submit', SubmitType::class, [
		        'label' => 'Generar venta',
		        'attr' => [
			        'class' => 'btn btn-lg btn-primary',
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
//            'data_class' => null,
	        'csrf_protection' => false,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
