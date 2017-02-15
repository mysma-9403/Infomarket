<?php

namespace AppBundle\Filter\Infomarket\Base;

use AppBundle\Filter\Base\Filter;

class BranchDependentFilter extends Filter {

	/**
	 * 
	 * @var integer
	 */
	protected $contextBranch = null;
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Filter\Base\Filter::initContextParams()
	 */
	public function initContextParams(array $contextParams) {
		$this->contextBranch = $contextParams['branch'];
	}
	
	/**
	 * @return integer
	 */
	public function getContextBranch() {
		return $this->contextBranch;
	}
}