<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\Main\Article;
use AppBundle\Factory\Common\Choices\Enum\ArticleImageSizesFactory;
use PHPUnit\Framework\TestCase;

class ArticleImageSizesFactoryTest extends TestCase {
	
	const INVALID_VALUE = -1;
	
	const TWIG_FUNCTION = 'articleImageSizeName';
	
	/**
	 * 
	 * @var ArticleImageSizesFactory
	 */
	protected $factory;
	
	
	
	protected function setUp() {
		$this->factory = new ArticleImageSizesFactory();
	}
	
	
	
	public function testGetFunctions() {
		$result = $this->factory->getFunctions();
	
		$this->assertArrayHasKey(self::TWIG_FUNCTION, $result);
	}
	
	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(Article::LARGE_IMAGE, $result);
		$this->assertContains(Article::MEDIUM_IMAGE, $result);
		$this->assertContains(Article::SMALL_IMAGE, $result);
	}
	
	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
	
		$this->assertFalse($result);
	}
}
