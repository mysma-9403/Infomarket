<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\ArticleFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		$this->addFilterTextField($builder, 'subname', 'label.subname');
		
		$this->addFilterBooleanChoiceField($builder, $options, 'infomarket');
		$this->addFilterBooleanChoiceField($builder, $options, 'infoprodukt');
		$this->addFilterBooleanChoiceField($builder, $options, 'featured');
		
		$this->addFilterEntityChoiceField($builder, $options, 'brands');
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
		$this->addFilterEntityChoiceField($builder, $options, 'articleCategories');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('infomarket')] = [ ];
		$options[$this->getChoicesName('infoprodukt')] = [ ];
		$options[$this->getChoicesName('featured')] = [ ];
		
		$options[$this->getChoicesName('brands')] = [ ];
		$options[$this->getChoicesName('categories')] = [ ];
		$options[$this->getChoicesName('articleCategories')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ArticleFilter::class;
	}
}