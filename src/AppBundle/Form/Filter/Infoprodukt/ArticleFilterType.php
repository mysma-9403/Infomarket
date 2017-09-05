<?php

namespace AppBundle\Form\Filter\Infoprodukt;

use AppBundle\Filter\Infoprodukt\Main\ArticleFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleFilterType extends FilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'articleCategories', false, true, true);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('articleCategories')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ArticleFilter::class;
	}
}