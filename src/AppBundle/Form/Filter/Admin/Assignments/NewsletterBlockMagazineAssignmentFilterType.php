<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\NewsletterBlockMagazineAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockMagazineAssignmentFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterBlocks');
		$this->addFilterEntityChoiceField($builder, $options, 'magazines');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterBlocks')] = [ ];
		$options[$this->getChoicesName('magazines')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterBlockMagazineAssignmentFilter::class;
	}
}