<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class LinkFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @var string
	 */
	protected $url = null;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->url = $this->getRequestValue($request, 'url');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->url = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestValue($values, 'url', $this->url);
		
		return $values;
	}
	
	/**
	 * Set url
	 *
	 * @param array $url
	 *
	 * @return LinkFilter
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	
		return $this;
	}
	
	/**
	 * Get term url
	 *
	 * @return array
	 */
	public function getUrl()
	{
		return $this->url;
	}
}