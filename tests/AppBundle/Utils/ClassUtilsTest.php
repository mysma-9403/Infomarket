<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Utils\ClassUtils;
use PHPUnit\Framework\TestCase;

class ClassUtilsTest extends TestCase {

	const CAMEL_CASE_ARTICLE_CATEGORY = 'ArticleCategory';

	const PARAM_CASE_ARTICLE_CATEGORY = 'articleCategory';

	const UNDERSCORE_ARTICLE_CATEGORY = 'article_category';

	public function testGetCamelCaseName() {
		$result = ClassUtils::getCamelCaseName(ArticleCategory::class);
		
		$this->assertSame(self::CAMEL_CASE_ARTICLE_CATEGORY, $result);
	}

	public function testGetParamCaseName() {
		$result = ClassUtils::getParamCaseName(ArticleCategory::class);
		
		$this->assertSame(self::PARAM_CASE_ARTICLE_CATEGORY, $result);
	}

	public function testGetUnderscoreName() {
		$result = ClassUtils::getUnderscoreName(ArticleCategory::class);
		
		$this->assertSame(self::UNDERSCORE_ARTICLE_CATEGORY, $result);
	}
}
