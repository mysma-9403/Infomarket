<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\Assignments\NewsletterUserNewsletterPageAssignment;
use AppBundle\Factory\Common\Choices\Enum\NewsletterUserNewsletterPageAssignmentStatesFactory;
use PHPUnit\Framework\TestCase;

class NewsletterUserNewsletterPageAssignmentStatesFactoryTest extends TestCase {

	const INVALID_VALUE = - 1;

	const TWIG_FUNCTION = 'newsletterUserNewsletterPageAssignmentStateName';

	/**
	 *
	 * @var NewsletterUserNewsletterPageAssignmentStatesFactory
	 */
	protected $factory;

	protected function setUp() {
		$this->factory = new NewsletterUserNewsletterPageAssignmentStatesFactory();
	}

	public function testGetFunctions() {
		$result = $this->factory->getFunctions();
		
		$this->assertArrayHasKey(self::TWIG_FUNCTION, $result);
	}

	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(NewsletterUserNewsletterPageAssignment::ERROR_STATE, $result);
		$this->assertContains(NewsletterUserNewsletterPageAssignment::SENDING_STATE, $result);
		$this->assertContains(NewsletterUserNewsletterPageAssignment::SENT_STATE, $result);
		$this->assertContains(NewsletterUserNewsletterPageAssignment::WAITING_STATE, $result);
	}

	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
		
		$this->assertFalse($result);
	}
}
