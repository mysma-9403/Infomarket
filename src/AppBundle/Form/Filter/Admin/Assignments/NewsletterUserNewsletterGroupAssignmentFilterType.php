<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\NewsletterUserNewsletterGroupAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserNewsletterGroupAssignmentFilterType extends SimpleFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterUsers');
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterGroups');
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