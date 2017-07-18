<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\Advert;
use AppBundle\Factory\Common\Choices\Enum\AdvertLocationsFactory;
use PHPUnit\Framework\TestCase;

class AdvertLocationsFactoryTest extends TestCase {
	
	const INVALID_VALUE = -1;
	
	const TWIG_FUNCTION = 'advertLocationName';
	
	/**
	 * 
	 * @var AdvertLocationsFactory
	 */
	protected $factory;
	
	
	
	public function __construct() {
		$this->factory = new AdvertLocationsFactory();
	}
	
	
	
	public function testGetFunctions() {
		$result = $this->factory->getFunctions();
	
		$this->assertArrayHasKey(self::TWIG_FUNCTION, $result);
	}
	
	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(Advert::FEATURED_LOCATION, $result);
		$this->assertContains(Advert::SIDE_LOCATION, $result);
		$this->assertContains(Advert::TEXT_LOCATION, $result);
		$this->assertContains(Advert::TOP_LOCATION, $result);
	}
	
	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
	
		$this->assertFalse($result);
	}
}
