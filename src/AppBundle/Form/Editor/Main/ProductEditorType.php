<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Product;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Editor\Transformer\BrandToNumberTransformer;

class ProductEditorType extends ImageEntityEditorType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		/** @var BrandRepository $brandRepository */
		$brandRepository = $this->em->getRepository(Brand::class);
		$brands = $brandRepository->findFilterItems();
		
		$builder
		->add('brand', ChoiceType::class, array(
				'choices' 		=> $brands,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('topProduktImage', ElFinderType::class, array(
				'instance'=>'topProdukt',
				'required' => false
		))
		->add('price', NumberType::class, array(
				'required' => false,
				'scale'	=> 2
		))
		->add('guarantee', IntegerType::class, array(
				'required' => false
		))
		;
		
		$builder->get('brand')->addModelTransformer(new BrandToNumberTransformer($this->em));
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Product::class;
	}
}