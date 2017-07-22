<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\AdvertCategoryAssignment;
use AppBundle\Factory\Common\Name\NameFactory;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertCategoryAssignmentEditorType extends BaseEntityEditorType
{
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $advertTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryTransformer;
	
	public function __construct(
			NameFactory $choicesNameFactory, 
			EntityToNumberTransformer $advertTransformer, 
			EntityToNumberTransformer $categoryTransformer) {
		parent::__construct($choicesNameFactory);
		
		$this->advertTransformer = $advertTransformer;
		$this->categoryTransformer = $categoryTransformer;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->advertTransformer, 'advert');
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->categoryTransformer, 'category');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('advert')] = [];
		$options[self::getChoicesName('category')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return AdvertCategoryAssignment::class;
	}
}