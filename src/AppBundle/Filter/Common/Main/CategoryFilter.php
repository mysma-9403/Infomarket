<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class CategoryFilter extends SimpleFilter {

	/**
	 *
	 * @var string
	 */
	protected $name = null;

	/**
	 *
	 * @var string
	 */
	protected $subname = null;

	/**
	 *
	 * @var integer
	 */
	protected $infomarket = self::ALL_VALUES;

	/**
	 *
	 * @var integer
	 */
	protected $infoprodukt = self::ALL_VALUES;

	/**
	 *
	 * @var integer
	 */
	protected $benchmark = self::ALL_VALUES;
	
	/**
	 *
	 * @var integer
	 */
	protected $featured = self::ALL_VALUES;

	/**
	 *
	 * @var integer
	 */
	protected $preleaf = self::ALL_VALUES;

	/**
	 *
	 * @var array
	 */
	protected $parents = array();

	/**
	 *
	 * @var array
	 */
	protected $branches = array();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
		$this->subname = $this->getRequestValue($request, 'subname');
		
		$this->infomarket = $this->getRequestBool($request, 'infomarket');
		$this->infoprodukt = $this->getRequestBool($request, 'infoprodukt');
		$this->benchmark = $this->getRequestBool($request, 'benchmark');
		$this->featured = $this->getRequestBool($request, 'featured');
		$this->preleaf = $this->getRequestBool($request, 'preleaf');
		
		$this->parents = $this->getRequestArray($request, 'parents');
		$this->branches = $this->getRequestArray($request, 'branches');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
		$this->subname = null;
		
		$this->infomarket = self::ALL_VALUES;
		$this->infoprodukt = self::ALL_VALUES;
		$this->benchmark = self::ALL_VALUES;
		$this->featured = self::ALL_VALUES;
		$this->preleaf = self::ALL_VALUES;
		
		$this->parents = array();
		$this->branches = array();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		$this->setRequestValue($values, 'subname', $this->subname);
		
		$this->setRequestBool($values, 'infomarket', $this->infomarket);
		$this->setRequestBool($values, 'infoprodukt', $this->infoprodukt);
		$this->setRequestBool($values, 'benchmark', $this->benchmark);
		$this->setRequestBool($values, 'featured', $this->featured);
		$this->setRequestBool($values, 'preleaf', $this->preleaf);
		
		$this->setRequestArray($values, 'parents', $this->parents);
		$this->setRequestArray($values, 'branches', $this->branches);
		
		return $values;
	}

	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setSubname($subname) {
		$this->subname = $subname;
		
		return $this;
	}

	public function getSubname() {
		return $this->subname;
	}

	public function setInfomarket($infomarket) {
		$this->infomarket = $infomarket;
		
		return $this;
	}

	public function getInfomarket() {
		return $this->infomarket;
	}

	public function setInfoprodukt($infoprodukt) {
		$this->infoprodukt = $infoprodukt;
		
		return $this;
	}

	public function getInfoprodukt() {
		return $this->infoprodukt;
	}
	
	public function setBenchmark($benchmark) {
		$this->benchmark = $benchmark;
	
		return $this;
	}
	
	public function getBenchmark() {
		return $this->benchmark;
	}

	public function setFeatured($featured) {
		$this->featured = $featured;
		
		return $this;
	}

	public function getFeatured() {
		return $this->featured;
	}

	public function setParents($parents) {
		$this->parents = $parents;
		
		return $this;
	}

	public function setPreleaf($preleaf) {
		$this->preleaf = $preleaf;
		
		return $this;
	}

	public function getPreleaf() {
		return $this->preleaf;
	}

	public function getParents() {
		return $this->parents;
	}

	public function setBranches($branches) {
		$this->branches = $branches;
		
		return $this;
	}

	public function getBranches() {
		return $this->branches;
	}
}