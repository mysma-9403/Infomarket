<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\NewsletterPageFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterPageFilterType extends SimpleFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterPageTemplates');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterPageTemplates')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterPageFilter::class;
	}
}