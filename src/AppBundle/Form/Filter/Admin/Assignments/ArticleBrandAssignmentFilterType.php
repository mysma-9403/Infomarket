<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\ArticleBrandAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleBrandAssignmentFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'articles');
		$this->addFilterEntityChoiceField($builder, $options, 'brands');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('articles')] = [ ];
		$options[$this->getChoicesName('brands')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ArticleBrandAssignmentFilter::class;
	}
}