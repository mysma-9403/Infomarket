<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ProductCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductCategoryAssignmentFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addChoiceEntityFilterField($builder, $options, 'products');
		$this->addChoiceEntityFilterField($builder, $options, 'brands');
		$this->addChoiceEntityFilterField($builder, $options, 'segments');
		$this->addChoiceEntityFilterField($builder, $options, 'categories');
		
		$this->addChoiceNumberFilterField($builder, $options, 'featured', false);
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