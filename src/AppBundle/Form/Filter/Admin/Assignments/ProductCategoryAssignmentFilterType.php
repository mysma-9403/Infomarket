<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\ProductCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductCategoryAssignmentFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'products');
		$this->addFilterEntityChoiceField($builder, $options, 'brands');
		$this->addFilterEntityChoiceField($builder, $options, 'segments');
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
		
		$this->addFilterBooleanChoiceField($builder, $options, 'featured');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('products')] = [ ];
		$options[$this->getChoicesName('brands')] = [ ];
		$options[$this->getChoicesName('segments')] = [ ];
		$options[$this->getChoicesName('categories')] = [ ];
		
		$options[$this->getChoicesName('featured')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ProductCategoryAssignmentFilter::class;
	}
}