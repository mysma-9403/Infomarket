<?php

namespace AppBundle\Filter\Infomarket\Base;

use AppBundle\Filter\Base\Filter;

class BranchDependentFilter extends Filter {

	/**
	 *
	 * @var integer
	 */
	protected $contextBranch = null;

	public function initContextParams(array $contextParams) {
		$this->contextBranch = $contextParams['branch'];
	}

	public function getContextBranch() {
		return $this->contextBranch;
	}
}