<?php

namespace AppBundle\Form\Filter\Admin\Other;

use AppBundle\Entity\Main\Category;
use AppBundle\Filter\Admin\Other\CategoryFilter;
use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryFilterType extends BaseType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'category', true, false);
	}

	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('category')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return CategoryFilter::class;
	}
}