<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\MagazineCategoryAssignment;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineCategoryAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $magazineTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;
	
	public function __construct(
			NameFactory $choicesNameFactory, 
			EntityToNumberTransformer $magazineTransformer, 
			EntityToNumberTransformer $categoryTransformer) {
		parent::__construct($choicesNameFactory);
		
		$this->magazineTransformer = $magazineTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->magazineTransformer, 'magazine');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->categoryTransformer, 'category');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('magazine')] = [];
		$options[self::getChoicesName('category')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return MagazineCategoryAssignment::class;
	}
}