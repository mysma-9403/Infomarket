<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class BenchmarkEnum extends Simple {

	/**
	 *
	 * @var string
	 */
	private $name;

	/**
	 *
	 * @var integer
	 */
	private $value;

	/**
	 *
	 * @var \AppBundle\Entity\Main\BenchmarkField
	 */
	private $benchmarkField;

	/**
	 * Set name
	 *
	 * @param string $name        	
	 *
	 * @return BenchmarkEnum
	 */
	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set value
	 *
	 * @param integer $value        	
	 *
	 * @return BenchmarkEnum
	 */
	public function setValue($value) {
		$this->value = $value;
		
		return $this;
	}

	/**
	 * Get value
	 *
	 * @return integer
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Set benchmarkField
	 *
	 * @param \AppBundle\Entity\Main\BenchmarkField $benchmarkField        	
	 *
	 * @return BenchmarkEnum
	 */
	public function setBenchmarkField(\AppBundle\Entity\Main\BenchmarkField $benchmarkField = null) {
		$this->benchmarkField = $benchmarkField;
		
		return $this;
	}

	/**
	 * Get benchmarkField
	 *
	 * @return \AppBundle\Entity\Main\BenchmarkField
	 */
	public function getBenchmarkField() {
		return $this->benchmarkField;
	}
}
