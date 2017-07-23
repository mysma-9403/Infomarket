<?php

namespace AppBundle\Form\Filter\Admin\Other;

use AppBundle\Filter\Admin\Other\SendNewsletterFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SendNewsletterFilterType extends BaseType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('embedImages', CheckboxType::class, array(
				'required'		=> false
		))
		->add('forceSend', CheckboxType::class, array(
				'required'		=> false
		))
		;
		
		$this->addEntityChoiceFilterField($builder, $options, 'newsletterGroups');
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterGroups')] = [];
		
		return $options;
	}
	
	protected function getEntityType() {
		return SendNewsletterFilter::class;
	}
}