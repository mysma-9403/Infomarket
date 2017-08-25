<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterUserNewsletterGroupAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserNewsletterGroupAssignmentFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'newsletterUsers');
		$this->addEntityChoiceFilterField($builder, $options, 'newsletterGroups');
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