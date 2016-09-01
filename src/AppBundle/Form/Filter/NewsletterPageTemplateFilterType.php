<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\NewsletterPageTemplateFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;

class NewsletterPageTemplateFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterPageTemplateFilter::class;
	}
}