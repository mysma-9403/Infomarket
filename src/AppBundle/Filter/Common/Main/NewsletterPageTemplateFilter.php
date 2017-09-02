<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterPageTemplateFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var string
	 */
	protected $name = null;

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		
		return $values;
	}

	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	public function getName() {
		return $this->name;
	}
}