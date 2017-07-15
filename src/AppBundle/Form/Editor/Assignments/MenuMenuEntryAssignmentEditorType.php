<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuMenuEntryAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $menuTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $menuEntryTransformer;
	
	public function __construct(EntityToNumberTransformer $menuTransformer, EntityToNumberTransformer $menuEntryTransformer) {
		$this->menuTransformer = $menuTransformer;
		$this->menuEntryTransformer = $menuEntryTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addChoiceEntityField($builder, $options, $this->menuTransformer, 'menu');
		$this->addChoiceEntityField($builder, $options, $this->menuEntryTransformer, 'menuEntry');
		
		$builder
		->add('orderNumber', IntegerType::class, array(
				'required'		=> true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('menu')] = [];
		$options[self::getChoicesName('menuEntry')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuMenuEntryAssignment::class;
	}
}