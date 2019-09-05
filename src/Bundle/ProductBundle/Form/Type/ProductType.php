<?php

namespace Bundle\ProductBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Bundle\CategoryBundle\Entity\Category;
use Bundle\ProductBundle\Entity\Unit;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Bundle\ProductBundle\Entity\Color;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ProductType extends AbstractType
{

    protected $em;
    protected $parentId;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getSize() {
        return [
	        "[ Seleccionar ]" => "",
        	17 => 17,
        	18 => 18,
        	19 => 19,
        	20 => 20,
        	21 => 21,
        	22 => 22,
        	23 => 23,
        	24 => 24,
        	25 => 25,
        	26 => 26,
        	27 => 27,
        	28 => 28,
        	29 => 29,
        	30 => 30,
        	31 => 31,
        	32 => 32,
        	33 => 33,
        	34 => 34,
        	35 => 35,
        	36 => 36,
        	37 => 37,
        	38 => 38,
        	39 => 39,
        	40 => 40,
        	41 => 41,
        	42 => 42,
        	43 => 43,
        ];
    }

    public function getSizeRange() {
        return [
	        "[ Seleccionar ]" => "",
        	"18 - 21" => "18-21",
        	"22 - 26" => "22-26",
        	"27 - 32" => "27-32",
        	"33 - 36" => "33-36",
        	"33 - 37" => "33-37",
        	"33 - 39" => "33-39",
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
                    'placeholder' => '[ Seleccionar ]',
                    'empty_data' => null,
                    'required' => false,
                    'label' => 'Categoría',
                    'label_attr' => [
                        'class' => ''
                    ],
                    'attr' => [
                        'class' => 'form-control hide',
                        'placeholder' => '',
                    ],
                ],
                $this->getDataType($options)
            ))
            ->add('unit', EntityType::class, [
	            'class' => Unit::class,
	            'query_builder' => function(EntityRepository $er) {
		            return $er->findAllObjects();
	            },
	            'placeholder' => '[ Seleccionar ]',
	            'empty_data' => null,
	            'required' => true,
	            'label' => 'Tipo de uso',
	            'label_attr' => [
		            'class' => ''
	            ],
	            'attr' => [
		            'class' => 'form-control',
		            'placeholder' => '',
	            ],
            ])
            ->add('color', EntityType::class, [
	            'class' => Color::class,
	            'query_builder' => function(EntityRepository $er) {
		            return $er->findAllObjects();
	            },
	            'placeholder' => '[ Seleccionar ]',
	            'empty_data' => null,
	            'required' => false,
	            'label' => 'Color',
	            'label_attr' => [
		            'class' => ''
	            ],
	            'attr' => [
		            'class' => 'form-control hide',
		            'placeholder' => '',
	            ],
            ])
            ->add('pdvHasproduct', EntityType::class, [
	            'class' => Pointofsale::class,
	            'query_builder' => function(EntityRepository $er) {
		            return $er->findAllObjects();
	            },
	            'placeholder' => '[ Seleccionar ]',
	            'empty_data' => null,
	            'required' => false,
                'expanded' => true,
                'multiple' => true,
//	                'empty_data' => [],
	            'label' => 'Punto de venta',
	            'label_attr' => [
		            'class' => ''
	            ],
	            'attr' => [
		            'class' => 'form-control ',
		            'placeholder' => '',
	            ],
            ])
            ->add('code', TextType::class, [
                'label' => 'code',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control random',
                    'placeholder' => 'code',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('price', TextType::class, [
                'label' => 'Precio de venta',
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '##.##',
                    'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');",
                ],
            ])
            ->add('cost', TextType::class, [
                'label' => 'Costo',
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '##.##',
                    'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');",
                ],
            ])
            ->add('barcode', TextType::class, [
                'label' => 'Barcode',
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'barcode',
	                'maxlength' => '20',
	                'onkeyup' => "this.value = this.value.replace(/[^0-9\.]/g,'');",
                ],
            ])
            ->add('reference', TextareaType::class, [
                'label' => 'Referencia interna',
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'referencia',
                ],
            ])
            ->add('size', ChoiceType::class, [
                'label' => 'Talla',
	            'choices' => $this->getSize(),
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
	                'style' => 'display:none;',
                ],
            ])
            ->add('sizeRange', ChoiceType::class, [
                'label' => false,
	            'choices' => $this->getSizeRange(),
	            'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'display:none;',
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
