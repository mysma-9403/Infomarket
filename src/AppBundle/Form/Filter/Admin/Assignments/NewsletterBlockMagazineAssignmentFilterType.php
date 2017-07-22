<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterBlockMagazineAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockMagazineAssignmentFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'newsletterBlocks');
		$this->addEntityChoiceFilterField($builder, $options, 'magazines');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterBlocks')] = [];
		$options[$this->getChoicesName('magazines')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return NewsletterBlockMagazineAssignmentFilter::class;
	}
}