<?php

namespace AppBundle\Manager\Decorator\Benchmark;

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
		$item->setReadByAdmin(false);
		$item->setReadByAuthor(true);
		
		return $item;
	}
}