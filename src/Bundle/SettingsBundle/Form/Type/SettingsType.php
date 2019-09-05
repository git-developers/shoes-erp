<?php

namespace Bundle\SettingsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityManager;
use Bundle\SettingsBundle\Entity\Settings;
use Doctrine\ORM\EntityRepository;

class SettingsType extends AbstractType
{
	
	protected $em;
	
	public function __construct(EntityManager $em) {
		$this->em = $em;
	}
	
	private function findAll() {
		return $this->em->getRepository(Settings::class)->findAll();
	}
	
	private function getClassValue($position = 0) {
		
		if (count($this->findAll()) > $position) {
			return $this->findAll()[$position]->getClassValue();
		}
		
		return null;
	}

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('systemEmail', EmailType::class, [
                'label' => 'Email del sistema',
	            'required' => true,
	            'data' => $this->getClassValue(0),
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'email',
                ],
            ])
	        ->add('salesQuantity', ChoiceType::class, [
		        'label' => 'Cantidad de venta',
		        'placeholder' => '[ Seleccione ]',
		        'choices' => [
		        	"0.5" => "0.5",
		        	"1" => "1",
		        	"6" => "6",
		        	"12" => "12",
		        ],
		        'data' => $this->getClassValue(1),
		        'required' => true,
		        'label_attr' => [
			        'class' => ''
		        ],
		        
		        'attr' => [
			        'class' => 'form-control',
		        ],
	        ])
	        ->add('salesQuantityPriceX', ChoiceType::class, [
		        'label' => 'Cantidad (x) Precio de venta',
		        'placeholder' => '[ Seleccione ]',
		        'choices' => [
		        	"1" => "1",
		        	"6" => "6",
		        	"12" => "12",
		        ],
		        'data' => $this->getClassValue(2),
		        'required' => true,
		        'label_attr' => [
			        'class' => ''
		        ],
		        
		        'attr' => [
			        'class' => 'form-control',
		        ],
	        ])
	        ->add('submit', SubmitType::class, [
		        'label' => 'Guardar',
		        'attr' => [
			        'class' => 'btn btn-success',
		        ],
	        ])
	        ->add('printerFilename', TextType::class, [
		        'label' => 'Printer Filename',
		        'required' => true,
		        'data' => $this->getClassValue(3),
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control',
			        'placeholder' => 'filename',
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
//            'data_class' => Settings::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
