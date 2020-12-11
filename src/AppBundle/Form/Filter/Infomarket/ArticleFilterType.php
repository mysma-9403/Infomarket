<?php

namespace AppBundle\Form\Filter\Infomarket;

use AppBundle\Filter\Infomarket\Main\ArticleFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleFilterType extends FilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'articleCategories', false, true, true);
		$this->addFilterEntityChoiceField($builder, $options, 'categories', false, true, true);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('articleCategories')] = [];
		$options[$this->getChoicesName('categories')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return ArticleFilter::class;
	}
}