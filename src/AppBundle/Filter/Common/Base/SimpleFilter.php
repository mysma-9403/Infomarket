<?php

namespace AppBundle\Filter\Common\Base;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class SimpleFilter extends BaseFilter {

	/**
	 *
	 * @var datetime
	 */
	protected $createdAfter = null;

	/**
	 *
	 * @var datetime
	 */
	protected $createdBefore = null;

	/**
	 *
	 * @var datetime
	 */
	protected $updatedAfter = null;

	/**
	 *
	 * @var datetime
	 */
	protected $updatedBefore = null;

	/**
	 *
	 * @var array
	 */
	protected $createdBy = array();

	/**
	 *
	 * @var array
	 */
	protected $updatedBy = array();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->updatedAfter = $this->getRequestTime($request, 'updated_after');
		$this->updatedBefore = $this->getRequestTime($request, 'updated_before');
		
		$this->createdAfter = $this->getRequestTime($request, 'created_after');
		$this->createdBefore = $this->getRequestTime($request, 'created_before');
		
		$this->updatedBy = $this->getRequestArray($request, 'updated_by');
		$this->createdBy = $this->getRequestArray($request, 'created_by');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->createdAfter = null;
		$this->createdBefore = null;
		
		$this->updatedAfter = null;
		$this->updatedBefore = null;
		
		$this->createdBy = array();
		$this->updatedBy = array();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestTime($values, 'updated_after', $this->updatedAfter);
		$this->setRequestTime($values, 'updated_before', $this->updatedBefore);
		
		$this->setRequestTime($values, 'created_after', $this->createdAfter);
		$this->setRequestTime($values, 'created_before', $this->createdBefore);
		
		$this->setRequestArray($values, 'updated_by', $this->updatedBy);
		$this->setRequestArray($values, 'created_by', $this->createdBy);
		
		return $values;
	}

	public function setCreatedAfter($createdAfter) {
		$this->createdAfter = $createdAfter;
		
		return $this;
	}

	public function getCreatedAfter() {
		return $this->createdAfter;
	}

	public function setCreatedBefore($createdBefore) {
		$this->createdBefore = $createdBefore;
		
		return $this;
	}

	public function getCreatedBefore() {
		return $this->createdBefore;
	}

	public function setUpdatedAfter($updatedAfter) {
		$this->updatedAfter = $updatedAfter;
		
		return $this;
	}

	public function getUpdatedAfter() {
		return $this->updatedAfter;
	}

	public function setUpdatedBefore($updatedBefore) {
		$this->updatedBefore = $updatedBefore;
		
		return $this;
	}

	public function getUpdatedBefore() {
		return $this->updatedBefore;
	}

	public function setCreatedBy($createdBy) {
		$this->createdBy = $createdBy;
		
		return $this;
	}

	public function getCreatedBy() {
		return $this->createdBy;
	}

	public function setUpdatedBy($updatedBy) {
		$this->updatedBy = $updatedBy;
		
		return $this;
	}

	public function getUpdatedBy() {
		return $this->updatedBy;
	}
}