<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Link;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\Page;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MenuEntryEditorType extends SimpleEntityEditorType
{
	/**
	 * 
	 * @var EntityToNumberTransformer
	 */
	protected $parentToNumberTransformer;
	
	/**
	 * 
	 * @var EntityToNumberTransformer
	 */
	protected $pageToNumberTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $linkToNumberTransformer;
	
	public function __construct(
			EntityToNumberTransformer $parentToNumberTransformer,
			EntityToNumberTransformer $pageToNumberTransformer,
			EntityToNumberTransformer $linkToNumberTransformer) {
		
		$this->parentToNumberTransformer = $parentToNumberTransformer;
		$this->pageToNumberTransformer = $pageToNumberTransformer;
		$this->linkToNumberTransformer = $linkToNumberTransformer;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('orderNumber', IntegerType::class, array(
				'required' => true
		))
		;
		
		$this->addChoiceEntityField($builder, $options, $this->parentToNumberTransformer, 'parent', false);
		$this->addChoiceEntityField($builder, $options, $this->pageToNumberTransformer, 'page');
		$this->addChoiceEntityField($builder, $options, $this->linkToNumberTransformer, 'link');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('parent')] = [];
		$options[self::getChoicesName('page')] = [];
		$options[self::getChoicesName('link')] = [];
		
		return $options;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MenuEntry::class;
	}
}