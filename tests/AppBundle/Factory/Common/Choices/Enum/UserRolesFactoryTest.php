<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\User;
use AppBundle\Factory\Common\Choices\Enum\UserRolesFactory;
use PHPUnit\Framework\TestCase;

class UserRolesFactoryTest extends TestCase {
	
	const INVALID_VALUE = -1;
	
	const TWIG_FUNCTION = 'userRoleName';
	
	
	
	/**
	 * 
	 * @var UserRolesFactory
	 */
	protected $factory;
	
	
	
	public function __construct() {
		$this->factory = new UserRolesFactory();
	}
	
	
	
	public function testGetFunctions() {
		$result = $this->factory->getFunctions();
	
		$this->assertArrayHasKey(self::TWIG_FUNCTION, $result);
	}
	
	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(User::ROLE_ADMIN, $result);
		$this->assertContains(User::ROLE_DEFAULT, $result);
		$this->assertContains(User::ROLE_EDITOR, $result);
		$this->assertContains(User::ROLE_PUBLISHER, $result);
		$this->assertContains(User::ROLE_RATING_EDITOR, $result);
		$this->assertContains(User::ROLE_SUPER_ADMIN, $result);
	}
	
	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
	
		$this->assertFalse($result);
	}
}
