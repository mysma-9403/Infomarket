<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ProductCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductCategoryAssignmentFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'products');
		$this->addEntityChoiceFilterField($builder, $options, 'brands');
		$this->addEntityChoiceFilterField($builder, $options, 'segments');
		$this->addEntityChoiceFilterField($builder, $options, 'categories');
		
		$this->addBooleanChoiceFilterField($builder, $options, 'featured');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('products')] = [];
		$options[$this->getChoicesName('brands')] = [];
		$options[$this->getChoicesName('segments')] = [];
		$options[$this->getChoicesName('categories')] = [];
		
		$options[$this->getChoicesName('featured')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return ProductCategoryAssignmentFilter::class;
	}
}