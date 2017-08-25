<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ArticleTagAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTagAssignmentFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'articles');
		$this->addEntityChoiceFilterField($builder, $options, 'tags');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('articles')] = [];
		$options[$this->getChoicesName('tags')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return ArticleTagAssignmentFilter::class;
	}
}