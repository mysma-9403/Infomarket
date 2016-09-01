<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\NewsletterBlockTemplateFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;

class NewsletterBlockTemplateFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockTemplateFilter::class;
	}
}