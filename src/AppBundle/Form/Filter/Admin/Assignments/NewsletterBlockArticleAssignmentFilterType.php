<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterBlockArticleAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockArticleAssignmentFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'newsletterBlocks');
		$this->addEntityChoiceFilterField($builder, $options, 'articles');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterBlocks')] = [];
		$options[$this->getChoicesName('articles')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return NewsletterBlockArticleAssignmentFilter::class;
	}
}