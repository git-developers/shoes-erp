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
use Bundle\ModuleBundle\Entity\Module;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Doctrine\ORM\EntityManagerInterface;


class PointofsaleModuleType extends AbstractType
{

    protected function findProfilesBySlugs($entityManager)
    {
//        $objects = $entityManager->getRepository(Module::class)->findProfilesBySlugs();
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

//        $entityManager = $options['entity_manager'];
        $modules = $options['modules'];

        $builder
            ->add('module', EntityType::class, array(
                'class' => Module::class,
                'query_builder' => function(EntityRepository $a) {
                    return $a->createQueryBuilder('a')
                        ->where('a.isActive = :active')
                        ->orderBy('a.id', 'DESC')
                        ->setParameter('active', true)
                        ;
                },
                'placeholder' => '[ Escoge una opción ]',
//                'empty_data' => null,
//                'data' => $this->findProfilesBySlugs($entityManager),
                'data' => $modules,
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Module',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'height:200px',
                ],
            ))
            ->add('submit', SubmitType::class, [
                'label' => 'Agregar',
                'attr' => [
                    'class' => 'btn btn-primary',
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
            'modules',
        ]);
    }

}
