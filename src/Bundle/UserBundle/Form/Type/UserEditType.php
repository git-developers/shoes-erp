<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Type;

use Bundle\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class UserEditType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('dob', DateType::class , [
                'label' => 'Fecha de nacimiento',
                'required' => false,
                'widget' => 'single_text',
                'label_attr' => ['class' => ''],
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
                'label' =>' Nombres',
                'label_attr' => array('class' => ''),
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'nombres',
                    'maxlength' => '45',
//                    'pattern' => '[a-zA-Z]+[ ][a-zA-Z]+',
                ],
                'error_bubbling' => true
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Apellidos',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'apellidos',
                    'maxlength' => '45',
//                    'pattern' => '[a-zA-Z]+[ ][a-zA-Z]+',
                ],
                'error_bubbling' => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'email',
                'required' => false,
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'test@test.com',
                ],
                'error_bubbling' => true
            ])
            ->add('aboutMe', TextareaType::class, [
                'label' => 'Sobre mi',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Sobre mi',
                ],
            ])
            ->add('headline', TextType::class, [
                'label' => 'Introducción',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Introducción',
                ],
            ])
//            ->add('image', FileType::class , array(
//                'label' => '',
//                'required' => false,
//                'label_attr' => ['style'=>'display:none'],
//                'attr' => [
//                    'style'=>'display:none',
//                ],
//                'data_class' => null,
//            ))
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn bg-primary pull-right',
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
            'data_class' => User::class,
        ]);
    }

}
