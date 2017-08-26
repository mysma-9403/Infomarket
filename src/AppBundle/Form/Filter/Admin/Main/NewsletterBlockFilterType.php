<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\NewsletterBlockFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
		
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterPages');
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterBlockTemplates');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterPages')] = [ ];
		$options[$this->getChoicesName('newsletterBlockTemplates')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterBlockFilter::class;
	}
}