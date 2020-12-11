<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockFilter extends SimpleFilter {

	/**
	 *
	 * @var string
	 */
	protected $name = null;

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
		
		$this->name = $this->getRequestString($request, 'name');
		
		$this->newsletterBlockTemplates = $this->getRequestArray($request, 'newsletter_block_templates');
		$this->newsletterPages = $this->getRequestArray($request, 'newsletter_pages');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
		
		$this->newsletterBlockTemplates = array();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		
		$this->setRequestArray($values, 'newsletter_block_templates', $this->newsletterBlockTemplates);
		$this->setRequestArray($values, 'newsletter_pages', $this->newsletterPages);
		
		return $values;
	}

	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setNewsletterBlockTemplates($newsletterBlockTemplates) {
		$this->newsletterBlockTemplates = $newsletterBlockTemplates;
		
		return $this;
	}

	public function getNewsletterBlockTemplates() {
		return $this->newsletterBlockTemplates;
	}

	public function setNewsletterPages($newsletterPages) {
		$this->newsletterPages = $newsletterPages;
		
		return $this;
	}

	public function getNewsletterPages() {
		return $this->newsletterPages;
	}
}