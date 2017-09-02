<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\NewsletterUserNewsletterPageAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserNewsletterPageAssignmentFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterPages');
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterUsers');
		
		$this->addFilterNumberChoiceField($builder, $options, 'states');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterPages')] = [ ];
		$options[$this->getChoicesName('newsletterUsers')] = [ ];
		
		$options[$this->getChoicesName('states')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterUserNewsletterPageAssignmentFilter::class;
	}
}