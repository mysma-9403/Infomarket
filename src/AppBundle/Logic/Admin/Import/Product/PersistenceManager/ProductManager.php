<?php

namespace AppBundle\Logic\Admin\Import\Product\PersistenceManager;

use AppBundle\Logic\Admin\Import\Common\SelectivePersistenceManager;

class ProductManager extends SelectivePersistenceManager {
	
	protected function canUpdate($entry) {
		return ! $entry['duplicate'];
	}
}