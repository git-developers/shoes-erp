<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Type;

use Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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

//abstract
//class UserType extends AbstractResourceType
class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            /*
            ->add('university', EntityType::class, array(
                'class' => University::class,
                'query_builder' => function(EntityRepository $a) {
                    return $a->createQueryBuilder('a')
                        ->where('a.isActive = :active')
                        ->orderBy('a.id', 'DESC')
                        ->setParameter('active', true)
                        ;
//                        ->add('orderBy', 's.sort_order ASC')
//                        ->innerJoin('a.languages', 'b')
//                        ->addSelect('b')
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => true,
                'label' => 'Universidad',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ))
            */


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
//            ->add('password', PasswordType::class, array(
//                'label' => 'Password',
//                'required' => false,
//                'label_attr' => array('class' => ''),
//                'attr' => array(
//                    'class' => 'form-control',
//                    'placeholder' => 'password',
//                ),
//            ))
//            ->add('username', TextType::class, array(
//                'label' => 'Username',
//                'required' => false,
//                'label_attr' => array('class' => ''),
//                'attr' => array(
//                    'class' => 'form-control',
//                    'placeholder' => 'username',
//                ),
//                'error_bubbling' => true
//            ))
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
//            ->add('dni', TextType::class, [
//                'label' => 'Dni',
//                'label_attr' => [
//                    'class' => ''
//                ],
//                'attr' => [
//                    'class' => 'form-control',
//                    'placeholder' => 'dni (8 caracteres)',
//                    'pattern'=>'[0-9]{8}',
//                    'maxlength'=>'8',
//                    'minlength'=>'8',
////                    'form'=>'user-form',
//                ],
//                'error_bubbling' => true
//            ])
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
//            ->add('headline', TextType::class, [
//                'label' => 'Introducción',
//                'label_attr' => [
//                    'class' => ''
//                ],
//                'attr' => [
//                    'class' => 'form-control',
//                    'placeholder' => 'Introducción',
//                ],
//            ])
            ->add('aboutMe', TextareaType::class, [
                'label' => 'Descripcion',
		        'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Sobre mi',
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
