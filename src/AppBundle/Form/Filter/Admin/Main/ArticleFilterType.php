<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\ArticleFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		$this->addFilterTextField($builder, 'subname', 'label.subname');
		
		$this->addBooleanChoiceFilterField($builder, $options, 'infomarket');
		$this->addBooleanChoiceFilterField($builder, $options, 'infoprodukt');
		$this->addBooleanChoiceFilterField($builder, $options, 'featured');
		
		$this->addEntityChoiceFilterField($builder, $options, 'brands');
		$this->addEntityChoiceFilterField($builder, $options, 'categories');
		$this->addEntityChoiceFilterField($builder, $options, 'articleCategories');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('infomarket')] = [];
		$options[$this->getChoicesName('infoprodukt')] = [];
		$options[$this->getChoicesName('featured')] = [];
		
		$options[$this->getChoicesName('brands')] = [];
		$options[$this->getChoicesName('categories')] = [];
		$options[$this->getChoicesName('articleCategories')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return ArticleFilter::class;
	}
}