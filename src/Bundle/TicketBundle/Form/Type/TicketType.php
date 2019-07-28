<?php

namespace Bundle\TicketBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bundle\UserBundle\Entity\User;
use Bundle\TicketBundle\Entity\PaymentType;


class TicketType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'Código',
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'code',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Descripción',
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'descripción',
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
			        'class' => 'form-control',
			        'placeholder' => '',
			        'style' => 'display: none',
		        ],
	        ))
	        ->add('paymentType', EntityType::class, array(
		        'class' => PaymentType::class,
		        'query_builder' => function(EntityRepository $er) {
			        return $er->findAllObjects();
		        },
		        'placeholder' => '[ Escoge tipo de pago ]',
		        'empty_data' => null,
		        'required' => false,
		        'label' => 'Tipo de pago',
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control',
			        'placeholder' => '',
		        ],
	        ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Ticket::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
