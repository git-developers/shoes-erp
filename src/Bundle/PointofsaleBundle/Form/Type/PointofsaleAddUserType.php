<?php

namespace Bundle\PointofsaleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bundle\ProfileBundle\Entity\Profile;
use Doctrine\ORM\EntityManagerInterface;


class PointofsaleAddUserType extends AbstractType
{

    protected function findProfilesBySlugs($entityManager)
    {
        $objects = $entityManager->getRepository(Profile::class)->findProfilesBySlugs([
            Profile::EMPLOYEE_SLUG,
            Profile::PDV_ADMIN_SLUG,
        ]);

        $array = [];
        foreach ($objects as $object) {
            $array['(' . $object->getId() . ') ' . $object->getName()] = $object->getId();
        }

        return $array;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $entityManager = $options['entity_manager'];

        $builder
            ->add('profile', ChoiceType::class, array(
                'choices' => $this->findProfilesBySlugs($entityManager),
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
            ->add('userTag', TextType::class, [
                'label' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nombre de usuario',
                ],
            ])
            ->add('userTagUsername', HiddenType::class, [
                'label' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'code',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Agregar',
                'attr' => [
                    'class' => 'btn btn-xs btn-success',
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
//            'data_class' => Pointofsale::class,
        ]);

        $resolver->setRequired([
            'form_data',
            'entity_manager',
        ]);
    }

}
