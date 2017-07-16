<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterUserNewsletterGroupAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserNewsletterGroupAssignmentFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addChoiceEntityFilterField($builder, $options, 'newsletterUsers');
		$this->addChoiceEntityFilterField($builder, $options, 'newsletterGroups');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterUsers')] = [];
		$options[$this->getChoicesName('newsletterGroups')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return NewsletterUserNewsletterGroupAssignmentFilter::class;
	}
}