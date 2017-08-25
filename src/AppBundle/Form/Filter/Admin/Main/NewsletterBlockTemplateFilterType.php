<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\NewsletterBlockTemplateFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockTemplateFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.name');
	}
	
	protected function getEntityType() {
		return NewsletterBlockTemplateFilter::class;
	}
}