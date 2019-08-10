<?php

namespace Bundle\ProfileBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManager;
use Bundle\RoleBundle\Entity\Role;
use Bundle\ProfileBundle\Entity\Profile;


class ProfileType extends AbstractType
{
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRoles() {
        return $this->em->getRepository(Role::class)->findAll();
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' =>' Nombre perfil',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('role', EntityType::class, [
                'choices' => $this->getRoles(),
                'class' => Role::class,
                'required' => true,
                'empty_data' => null,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Roles del perfil',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('toggleCheckbox', CheckboxType::class, [
                'label' =>'Check all',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => '',
                    'placeholder' => '',
                ],
            ])
            ->add('collapsedBox', CheckboxType::class, [
                'label' =>'Collapsed Box',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => '',
                    'placeholder' => '',
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
            'data_class' => Profile::class,
            'form_data' => [],
        ]);
    }

}
