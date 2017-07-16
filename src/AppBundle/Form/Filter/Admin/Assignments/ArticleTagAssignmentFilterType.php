<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ArticleTagAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTagAssignmentFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addChoiceEntityFilterField($builder, $options, 'articles');
		$this->addChoiceEntityFilterField($builder, $options, 'tags');
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