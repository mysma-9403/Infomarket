<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Base\FeaturedEntityEditorType;
use AppBundle\Form\Editor\Transformer\CategoryToNumberTransformer;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryEditorType extends FeaturedEntityEditorType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->em->getRepository(Category::class);
		$categories = $categoryRepository->findFilterItems();
		
		$builder
		->add('subname', null, array(
				'required' => false
		))
		->add('orderNumber', null, array(
				'required' => true
		))
		->add('icon', null, array(
				'required' => false
		))
		->add('iconImage', ElFinderType::class, array(
				'instance'=>'icon',
				'required' => false
		))
		->add('featuredImage', ElFinderType::class, array(
				'instance'=>'featured',
				'required' => false
		))
		->add('parent', ChoiceType::class, array(
				'choices'		=> $categories,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => false,
				'placeholder' 	=> 'label.placeholder.none'
		))
		->add('benchmark', CheckboxType::class, array(
				'required' => false
		))
		->add('preleaf', CheckboxType::class, array(
				'required' => false
		))
		->add('content', CKEditorType::class, array(
				'config' => array(
						'uiColor' => '#ffffff'),
				'required' => false
		))
		;
		
		$builder->get('parent')->addModelTransformer(new CategoryToNumberTransformer($this->em));
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Category::class;
	}
}