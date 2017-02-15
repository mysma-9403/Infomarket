<?php

namespace AppBundle\Filter\Admin\Base;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class SimpleFilter extends AuditFilter {
	
	/**
	 * @var integer
	 */
	protected $infomarket = self::ALL_VALUES;
	
	/**
	 * @var integer
	 */
	protected $infoprodukt = self::ALL_VALUES;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->infomarket = $this->getRequestBool($request, 'infomarket');
		$this->infoprodukt = $this->getRequestBool($request, 'infoprodukt');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->infomarket = self::ALL_VALUES;
		$this->infoprodukt = self::ALL_VALUES;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestBool($values, 'infomarket', $this->infomarket);
		$this->setRequestBool($values, 'infoprodukt', $this->infoprodukt);

		return $values;
	}
	
	
	
	/**
	 * Set infomarket
	 *
	 * @param integer $infomarket
	 *
	 * @return SimpleEntityFilter
	 */
	public function setInfomarket($infomarket)
	{
		$this->infomarket = $infomarket;
	
		return $this;
	}
	
	/**
	 * Get infomarket
	 *
	 * @return integer
	 */
	public function getInfomarket()
	{
		return $this->infomarket;
	}
	
	/**
	 * Set infoprodukt
	 *
	 * @param integer $infoprodukt
	 *
	 * @return SimpleEntityFilter
	 */
	public function setInfoprodukt($infoprodukt)
	{
		$this->infoprodukt = $infoprodukt;
	
		return $this;
	}
	
	/**
	 * Get infoprodukt
	 *
	 * @return integer
	 */
	public function getInfoprodukt()
	{
		return $this->infoprodukt;
	}
}