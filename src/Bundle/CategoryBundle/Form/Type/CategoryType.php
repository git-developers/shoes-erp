<?php

namespace Bundle\CategoryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Bundle\CategoryBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CategoryType extends AbstractType
{
    protected $em;
    protected $parentId;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getParentItem($id) {
        return $this->em->getRepository(Category::class)->find($id);
    }

    public function getParentId($options) {
        $object = (object) $options['form_data'];
        return isset($object->parent_id) ? $object->parent_id : null;
    }

    public function getEntityType($options) {
        $object = (object) $options['form_data'];
        return isset($object->entity_type) ? strtoupper($object->entity_type) : null;
    }

    public function getDataType($options): array {

        $data = [];
        $type = $this->getEntityType($options);

        if (!is_null($type)) {
            $data = [
                'data' => $this->getEntityType($options)
            ];
        }

        return $data;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $this->em;
        $this->parentId = $this->getParentId($options);

        $builder
            ->add('type', HiddenType::class, array_merge(
                [
                    'label' =>'type',
                    'label_attr' => [
                        'class' => ''
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'type',
                    ],
                ],
                $this->getDataType($options)
            ))
//            ->add('code', TextType::class, [
//                'label' =>' code',
//                'label_attr' => [
//                    'class' => ''
//                ],
//                'attr' => [
//                    'class' => 'form-control',
//                    'placeholder' => 'code',
//                ],
//            ])
            ->add('name', TextType::class, [
                'label' =>' Nombre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($em) {
//            $data = $event->getData();
            $form = $event->getForm();

            $options = [
                'class' => Category::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllObjects();
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => false,
                'label' => 'category',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ];

            if($this->parentId != null){
                $data = ['data' => $this->getParentItem($this->parentId)];
                $options = array_merge($options, $data);
            }

            $form->add('category', EntityType::class, $options);

        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
            'form_data' => [],
        ]);
    }

}
