<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;


final class PdvLoginType extends AbstractType
{

    protected $router;
    protected $pdv;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->pdv = $options['pdv'];
	
	    $builder
            ->setAction($this->router->generate('backend_security_login_check'))
            ->add('pointOfSale', EntityType::class, [
                'class' => Pointofsale::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllObjectsByPdv($this->pdv);
                },
                'placeholder' => '[ Escoja una sucursal ]',
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
	            'constraints' => [
		            new NotBlank(),
	            ],
            ])
            ->add('_username', EmailType::class, [
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'email',
                ],
	            'constraints' => [
		            new NotBlank(),
		            new Length([
			            'min' => 1
		            ]),
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
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return null;
//        return 'sylius_user_security_login';
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
            'pdv',
        ]);
    }
}
