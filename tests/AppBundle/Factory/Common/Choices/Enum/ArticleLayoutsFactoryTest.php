<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\Main\Article;
use AppBundle\Factory\Common\Choices\Enum\ArticleLayoutsFactory;
use PHPUnit\Framework\TestCase;

class ArticleLayoutsFactoryTest extends TestCase {

	const INVALID_VALUE = - 1;

	const TWIG_FUNCTION = 'articleLayoutName';

	/**
	 *
	 * @var ArticleLayoutsFactory
	 */
	protected $factory;

	protected function setUp() {
		$this->factory = new ArticleLayoutsFactory();
	}

	public function testGetFunctions() {
		$result = $this->factory->getFunctions();
		
		$this->assertArrayHasKey(self::TWIG_FUNCTION, $result);
	}

	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(Article::BOTTOM_LAYOUT, $result);
		$this->assertContains(Article::LEFT_LAYOUT, $result);
		$this->assertContains(Article::MID_LAYOUT, $result);
		$this->assertContains(Article::RIGHT_LAYOUT, $result);
	}

	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
		
		$this->assertFalse($result);
	}
}
