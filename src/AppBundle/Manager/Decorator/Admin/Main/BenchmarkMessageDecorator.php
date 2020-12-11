<?php

namespace AppBundle\Manager\Decorator\Admin\Main;

use AppBundle\Manager\Decorator\Base\ItemDecorator;
use AppBundle\Entity\Main\BenchmarkMessage;

class BenchmarkMessageDecorator extends ItemDecorator {
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Manager\Decorator\Base\ItemDecorator::getPrepared()
	 * 
	 * @param BenchmarkMessage $item
	 */
	public function getPrepared($item) {
		$item->setReadByAdmin(true);
		$item->setReadByAuthor(false);
		
		return $item;
	}
}