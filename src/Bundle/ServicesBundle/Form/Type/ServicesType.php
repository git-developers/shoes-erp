<?php

namespace Bundle\ServicesBundle\Form\Type;

use Bundle\CategoryBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;


class ServicesType extends AbstractType
{

    protected $em;
    protected $parentId;

    public function __construct(EntityManager $em) {
        $this->em = $em;
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
            ->add('price', MoneyType::class, [
                'label' => 'precio',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '00.00',
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
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Services::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
