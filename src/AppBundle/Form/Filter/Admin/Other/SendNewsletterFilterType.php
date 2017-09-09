<?php

namespace AppBundle\Form\Filter\Admin\Other;

use AppBundle\Filter\Admin\Other\SendNewsletterFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SendNewsletterFilterType extends BaseType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addCheckboxField($builder, 'embedImages', 'label.newsletterPage.sendNewsletter.embedImages');
		$this->addCheckboxField($builder, 'forceSend', 'label.newsletterPage.sendNewsletter.forceSend');
		
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterGroups');
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