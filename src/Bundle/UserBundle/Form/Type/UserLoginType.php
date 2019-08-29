<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\OptionsResolver\OptionsResolver;


final class UserLoginType extends AbstractType
{

    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
//            ->setAction($this->router->generate('fos_user_security_check'))
            ->setAction($this->router->generate('backend_security_login_check'))
            ->add('_username', TextType::class, [
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'email',
                ],
            ])
            ->add('_password', PasswordType::class, [
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '****',
                ],
            ])
            ->add('_csrf_token', HiddenType::class, [
                'required' => true,
            ])
            ->add('_remember_me', CheckboxType::class, [
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
            ->add('submit', SubmitType::class, [
                'label' => 'login',
                'attr' => [
                    'class' => 'btn bg-yellow btn-block btn-flat',
                ],
            ])
        ;
    }

    /**
     * This will remove formTypeName from the form
     * @return null
     */
    public function getBlockPrefix()
    {
//        return 'sylius_user_security_login';
        return null;
    }

}
