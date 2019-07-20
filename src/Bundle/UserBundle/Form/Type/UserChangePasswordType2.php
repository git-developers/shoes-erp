<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UserChangePasswordType2 extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'label' => false,
                'invalid_message' => 'Los passwords no coincide.',
                'options' => [
                    'attr' => [
                        'class' => 'GATO',
                    ],
                    'label_attr' => [
                        'class' => 'control-label required'
                    ],
                ],
                'required' => true,
                'first_options'  => [
                    'label' => 'Nuevo password',
                    'attr' => [
                        'class' => 'form-control password-field',
                        'placeholder' => '****',
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmar password',
                    'attr' => [
                        'class' => 'form-control password-field',
                        'placeholder' => '****',
                    ],
                ],
            ])
            ->add('togglePassword', CheckboxType::class, [
                'label' =>' Mostrar password',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'pull-left',
                    'style' => 'width:20px; height:20px; margin-right:5px',
                    'placeholder' => '',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Cambiar password',
                'attr' => [
                    'class' => 'btn bg-yellow btn-block btn-flat',
                ],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_user_change_password';
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
}
