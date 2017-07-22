<?php

namespace AppBundle\Factory\Common\Name;

class ChoicesNameFactory implements NameFactory{
	
	const CHOICES = 'Choices';
	
	public function getName($name) {
		return $name . self::CHOICES;
	}
}