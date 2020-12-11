<?php

namespace AppBundle\Misc\ValueProvider;

interface ValueProvider {
	
	public function getValue(array $fields, $key);
}