<?php

namespace AppBundle\Logic\Admin\Import\Product\PersistenceManager;

use AppBundle\Logic\Admin\Import\Common\SelectivePersistenceManager;

class BenchmarkFieldManager extends SelectivePersistenceManager {
	
	protected function canUpdate($entry) {
		return key_exists('fieldType', $entry); 
	}
}