<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ArticleBrandAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleBrandAssignmentFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'articles');
		$this->addEntityChoiceFilterField($builder, $options, 'brands');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('articles')] = [];
		$options[$this->getChoicesName('brands')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return ArticleBrandAssignmentFilter::class;
	}
}