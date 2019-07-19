<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Type;

use Bundle\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class UserAvatarType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->setMethod('POST')
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
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn bg-primary pull-left',
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
