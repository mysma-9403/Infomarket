<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserFilter extends SimpleEntityFilter {
	
	/**
	 *
	 * @var integer
	 */
	protected $subscribed = self::ALL_VALUES;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->subscribed = $this->getRequestBool($request, 'subscribed');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->subscribed = self::ALL_VALUES;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestBool($values, 'subscribed', $this->subscribed);
		
		return $values;
	}
	
	/**
	 * Set subscribed
	 *
	 * @param array $subscribed
	 *
	 * @return NewsletterUserFilter
	 */
	public function setSubscribed($subscribed)
	{
		$this->subscribed = $subscribed;
	
		return $this;
	}
	
	/**
	 * Get term subscribed
	 *
	 * @return array
	 */
	public function getSubscribed()
	{
		return $this->subscribed;
	}
}