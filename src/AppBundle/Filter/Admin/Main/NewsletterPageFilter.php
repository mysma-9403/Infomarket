<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterPageFilter extends SimpleEntityFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterPageTemplates = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->newsletterPageTemplates = $this->getRequestArray($request, 'newsletter_page_templates');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->newsletterPageTemplates = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'newsletter_page_templates', $this->newsletterPageTemplates);
		
		return $values;
	}
	
	/**
	 * Set newsletterPageTemplates
	 *
	 * @param array $newsletterPageTemplates
	 *
	 * @return NewsletterPageFilter
	 */
	public function setNewsletterPageTemplates($newsletterPageTemplates)
	{
		$this->newsletterPageTemplates = $newsletterPageTemplates;
	
		return $this;
	}
	
	/**
	 * Get term newsletterPageTemplates
	 *
	 * @return array
	 */
	public function getNewsletterPageTemplates()
	{
		return $this->newsletterPageTemplates;
	}
}