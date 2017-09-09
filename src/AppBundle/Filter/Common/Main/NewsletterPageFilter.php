<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterPageFilter extends SimpleFilter {

	/**
	 *
	 * @var string
	 */
	protected $name = null;

	/**
	 *
	 * @var array
	 */
	protected $newsletterPageTemplates = array();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
		
		$this->newsletterPageTemplates = $this->getRequestArray($request, 'newsletter_page_templates');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
		
		$this->newsletterPageTemplates = array();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		
		$this->setRequestArray($values, 'newsletter_page_templates', $this->newsletterPageTemplates);
		
		return $values;
	}

	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setNewsletterPageTemplates($newsletterPageTemplates) {
		$this->newsletterPageTemplates = $newsletterPageTemplates;
		
		return $this;
	}

	public function getNewsletterPageTemplates() {
		return $this->newsletterPageTemplates;
	}
}