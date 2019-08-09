<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Type;

use Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Bundle\ProfileBundle\Entity\Profile;

class UserEmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    $builder
		    ->add('profile', EntityType::class, array(
			    'class' => Profile::class,
			    'query_builder' => function(EntityRepository $er) {
				    return $er->findAllObjects();
			    },
			    'placeholder' => '[ Escoge una opción ]',
			    'empty_data' => null,
			    'required' => true,
			    'label' => 'Perfil',
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control',
				    'placeholder' => '',
			    ],
		    ))
		    ->add('phone', IntegerType::class, [
			    'label' => 'Telefono',
			    'required' => false,
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control',
				    'placeholder' => 'ingrese el telefono del usuario',
			    ],
			    'error_bubbling' => true
		    ])
		    ->add('dob', DateType::class , [
			    'label' => 'Fecha de nacimiento',
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
//            ->add('image', FileType::class , [
//                'label' => 'Selecciona tu foto',
//                'required' => true,
//                'label_attr' => ['class' => ''],
//                'attr' => [
//                    'class' => 'form-control',
//                    'title'=>'',
//                ],
//                'data_class' => null,
//                'error_bubbling' => true
//            ])
		    ->add('dni', TextType::class, [
			    'label' => 'Dni',
			    'required' => false,
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control',
				    'placeholder' => '8 caracteres',
				    'pattern'=>'[0-9]{8}',
				    'maxlength'=>'8',
				    'minlength'=>'8',
//                    'form'=>'user-form',
			    ],
			    'error_bubbling' => true
		    ])
		    ->add('ruc', TextType::class, [
			    'label' => 'Ruc',
			    'required' => false,
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control',
				    'placeholder' => '11 caracteres',
				    'pattern'=>'[0-9]{11}',
				    'maxlength'=>'11',
				    'minlength'=>'11',
			    ],
			    'error_bubbling' => true
		    ])
		    ->add('address', TextareaType::class, [
			    'label' => 'Dirección',
			    'required' => false,
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control',
				    'placeholder' => 'Dirección',
			    ],
			    'error_bubbling' => true
		    ])
		    ->add('name', TextType::class, [
			    'label' =>' Nombres',
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control required',
				    'placeholder' => 'nombres',
			    ],
		    ])
		    ->add('lastName', TextType::class, [
			    'label' => 'Apellidos',
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control required',
				    'placeholder' => 'apellidos',
			    ],
		    ])
		    ->add('webSite', UrlType::class, [
			    'label' => 'Sitio web',
			    'required' => false,
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control required',
				    'placeholder' => 'http://...',
			    ],
		    ])
		    ->add('aboutMe', TextareaType::class, [
			    'label' => 'Descripción',
			    'required' => false,
			    'label_attr' => [
				    'class' => '',
			    ],
			    'attr' => [
				    'class' => 'form-control',
				    'placeholder' => 'Sobre el usuario',
			    ],
		    ])
		    ->add('email', EmailType::class, [
			    'label' => 'email',
			    'required' => true,
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => 'form-control required',
				    'placeholder' => 'test@example.com',
			    ],
			    //'error_bubbling' => true
		    ])
		    ->add('isActive', CheckboxType::class, [
			    'label' => 'Activo',
			    'required' => false,
			    'label_attr' => [
				    'class' => ''
			    ],
			    'attr' => [
				    'class' => '',
				    'placeholder' => 'Activo',
			    ],
		    ])
	    ;
	
	
	    /*
		$builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($em) {
			$data = $event->getData();
			$form = $event->getForm();
		});
		*/
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Product::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

    /*
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => $this->dataClass,
                'validation_groups' => function (FormInterface $form): array {
                    $data = $form->getData();
                    if ($data && !$data->getId()) {
                        $this->validationGroups[] = 'sylius_user_create';
                    }

                    return $this->validationGroups;
                },
            ])
        ;
    }
    */
}
