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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PaymentHistoryType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	        ->add('salesId', HiddenType::class, [
		        'label' => false,
		        'required' => false,
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => '',
		        ],
	        ])
	        ->add('payment', TextType::class, [
		        'label' => 'Pago',
		        'required' => true,
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control text-right',
			        'placeholder' => '##.##',
			        'autocomplete' => 'off',
			        'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');",
		        ],
	        ])
	        ->add('changeBack', TextType::class, [
		        'label' => 'Vuelto',
		        'required' => true,
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control text-right',
			        'placeholder' => '##.##',
			        'readonly' => 'readonly',
			        'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');",
		        ],
	        ])
	        ->add('paymentType', EntityType::class, array(
		        'class' => PaymentType::class,
		        'query_builder' => function(EntityRepository $er) {
			        return $er->findAllObjects();
		        },
		        'placeholder' => '[ Escoge forma de pago ]',
		        'empty_data' => null,
		        'required' => true,
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
		        'label' => 'Agregar pago',
		        'attr' => [
			        'class' => 'btn btn-outline',
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
//	        'csrf_protection' => false,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
