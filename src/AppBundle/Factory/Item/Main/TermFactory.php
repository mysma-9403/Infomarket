<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Term;
use AppBundle\Factory\Item\Base\ItemFactory;

class TermFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Term::class);
	}
}