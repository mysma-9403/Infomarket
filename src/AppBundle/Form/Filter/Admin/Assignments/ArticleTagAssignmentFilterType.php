<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\ArticleTagAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTagAssignmentFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'articles');
		$this->addFilterEntityChoiceField($builder, $options, 'tags');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('articles')] = [ ];
		$options[$this->getChoicesName('tags')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ArticleTagAssignmentFilter::class;
	}
}