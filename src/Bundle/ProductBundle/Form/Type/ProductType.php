<?php

namespace Bundle\ProductBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Bundle\CategoryBundle\Entity\Category;
use Bundle\ProductBundle\Entity\Unit;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

class ProductType extends AbstractType
{

    protected $em;
    protected $parentId;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getSizes() {
        return [
        	6 => 6,
        	7 => 7,
        	8 => 8,
        	9 => 9,
        	10 => 10,
        	11 => 11,
        	12 => 12,
        ];
    }

    public function getCategory($id) {
        return $this->em->getRepository(Category::class)->find($id);
    }

    public function getCategoryId($options) {
        $object = (object) $options['form_data'];
        return isset($object->category_id) ? $object->category_id : null;
    }

    public function getDataType($options): array {

        $data = [];
        $categoryId = $this->getCategoryId($options);

        if (!is_null($categoryId)) {
            $data = [
                'data' => $this->getCategory($categoryId)
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

        $builder
            ->add('category', EntityType::class, array_merge(
                [
                    'class' => Category::class,
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findAllObjects();
                    },
                    'placeholder' => '[ Escoge una opción ]',
                    'empty_data' => null,
                    'required' => false,
                    'label' => 'Categoría',
                    'label_attr' => [
                        'class' => ''
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => '',
                    ],
                ],
                $this->getDataType($options)
            ))
            ->add('unit', EntityType::class, array_merge(
                [
                    'class' => Unit::class,
                    'query_builder' => function(EntityRepository $er) {
                        return $er->findAllObjects();
                    },
                    'placeholder' => '[ Escoge una opción ]',
                    'empty_data' => null,
                    'required' => true,
                    'label' => 'Unidad de uso',
                    'label_attr' => [
                        'class' => ''
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => '',
                    ],
                ],
                $this->getDataType($options)
            ))
            ->add('code', TextType::class, [
                'label' =>' code',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'code',
                ],
            ])
            ->add('color', ColorType::class, [
                'label' =>' color',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'color',
                ],
            ])
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
            ->add('stock', IntegerType::class, [
                'label' =>' Stock',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '##',
                ],
            ])
            ->add('size', ChoiceType::class, [
                'label' =>' Talla',
	            'choices' => $this->getSizes(),
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '##',
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
//            'data_class' => Product::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
