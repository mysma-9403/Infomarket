<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Category;
use AppBundle\Factory\Common\Name\ChoicesNameFactory;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryEditorType extends ImageEntityEditorType
{
	/**
	 * 
	 * @var EntityToNumberTransformer
	 */
	protected $categoryToNumberTransformer;
	
	public function __construct(NameFactory $choicesNameFactory, EntityToNumberTransformer $categoryToNumberTransformer) {
		parent::__construct($choicesNameFactory);
		
		$this->categoryToNumberTransformer = $categoryToNumberTransformer;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('subname', TextType::class, array(
				'required' => false
		))
		->add('orderNumber', IntegerType::class, array(
				'required' => true
		))
		->add('icon', TextType::class, array(
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
		->add('benchmark', CheckboxType::class, array(
				'required' => false
		))
		->add('featured', CheckboxType::class, array(
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
		
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->categoryToNumberTransformer, 'parent', false);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('parent')] = [];
	
		return $options;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Category::class;
	}
}