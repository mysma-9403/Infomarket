<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Main\Branch;

class HomeContextParamsManager extends ContextParamsManager {
	
	// TODO refine - quick fix...
	protected function initBranch($branches, $branch) {
		return $branch;
	}
}