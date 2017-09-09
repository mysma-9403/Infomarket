<?php

namespace Tests\AppBundle\Factory\Common\Message;

use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Factory\Common\Message\ClassMessageFactory;
use AppBundle\Factory\Common\Message\LifecycleMessageFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\TranslatorInterface;

class LifecycleMessageFactoryTest extends TestCase {

	const MESSAGE_LABEL = 'message.label';

	const MESSAGE = 'Test message for: %type%.';

	const ARTICLE_CATEGORY_LABEL = 'label.articleCategory';

	const ARTICLE_CATEGORY = 'Kategoria artykulow';

	const EXPECTED = 'Test message for: <b>Kategoria artykulow</b>.';

	/**
	 *
	 * @var ClassMessageFactory
	 */
	protected $factory;

	protected function setUp() {
		$this->factory = new LifecycleMessageFactory($this->getTranslatorMock());
	}

	public function testGetMessage() {
		$result = $this->factory->getMessage(self::MESSAGE_LABEL, ArticleCategory::class);
		
		$this->assertSame(self::EXPECTED, $result);
	}

	protected function getTranslatorMock() {
		$mock = $this->getMockBuilder(TranslatorInterface::class)->disableOriginalConstructor()->getMock();
		
		$mock->expects($this->exactly(2))->method('trans')->willReturnMap(
				[[self::ARTICLE_CATEGORY_LABEL, [], null, null, self::ARTICLE_CATEGORY], 
						[self::MESSAGE_LABEL, [], null, null, self::MESSAGE]]);
		
		return $mock;
	}
}
