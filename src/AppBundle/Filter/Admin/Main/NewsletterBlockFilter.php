<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockFilter extends SimpleEntityFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterBlockTemplates = array();
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterPages = array();
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->newsletterBlockTemplates = $this->getRequestArray($request, 'newsletter_block_templates');
		$this->newsletterPages = $this->getRequestArray($request, 'newsletter_pages');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->newsletterBlockTemplates = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'newsletter_block_templates', $this->newsletterBlockTemplates);
		$this->setRequestArray($values, 'newsletter_pages', $this->newsletterPages);
		
		return $values;
	}
	
	/**
	 * Set newsletterBlockTemplates
	 *
	 * @param array $newsletterBlockTemplates
	 *
	 * @return NewsletterBlockFilter
	 */
	public function setNewsletterBlockTemplates($newsletterBlockTemplates)
	{
		$this->newsletterBlockTemplates = $newsletterBlockTemplates;
	
		return $this;
	}
	
	/**
	 * Get term newsletterBlockTemplates
	 *
	 * @return array
	 */
	public function getNewsletterBlockTemplates()
	{
		return $this->newsletterBlockTemplates;
	}
	
	/**
	 * Set newsletterPages
	 *
	 * @param array $newsletterPages
	 *
	 * @return NewsletterBlockFilter
	 */
	public function setNewsletterPages($newsletterPages)
	{
		$this->newsletterPages = $newsletterPages;
	
		return $this;
	}
	
	/**
	 * Get term newsletterPages
	 *
	 * @return array
	 */
	public function getNewsletterPages()
	{
		return $this->newsletterPages;
	}
}