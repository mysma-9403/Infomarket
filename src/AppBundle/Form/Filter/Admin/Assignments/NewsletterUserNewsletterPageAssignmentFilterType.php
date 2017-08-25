<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterUserNewsletterPageAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserNewsletterPageAssignmentFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'newsletterPages');
		$this->addEntityChoiceFilterField($builder, $options, 'newsletterUsers');
		
		$this->addNumberChoiceFilterField($builder, $options, 'states');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterPages')] = [];
		$options[$this->getChoicesName('newsletterUsers')] = [];
		
		$options[$this->getChoicesName('states')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return NewsletterUserNewsletterPageAssignmentFilter::class;
	}
}