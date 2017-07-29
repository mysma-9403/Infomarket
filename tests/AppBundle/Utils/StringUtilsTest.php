<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Utils\StringUtils;
use PHPUnit\Framework\TestCase;

class StringUtilsTest extends TestCase {

	const TWIG_FILTER = 'cleanName';
	
	
	
	const EMPTY_NAME = '';
	const CLEAN_NAME = 'test';
	const DIRTY_NAME = 'Tęst';
	
	const CLEAN_DOUBLE_PAUSE_NAME = 'kruger-matz';
	const DIRTY_DOUBLE_PAUSE_NAME = 'KRÜGER & MĄTŹ';
	
	
	
	const EMPTY_PATH = '';
	const CLEAN_PATH = 'test/path/to/some/image';
	const DIRTY_PATH = 'test/pąth/tó/some/image';
	
	const CLEAN_DOUBLE_PAUSE_PATH = 'kroger-matz/';
	const DIRTY_DOUBLE_PAUSE_PATH = 'Króger & Matz/';
	
	const CLEAN_DOUBLE_SLASH_PATH = 'kr/ger';
	const DIRTY_DOUBLE_SLASH_PATH = 'Kr/&/ger';
	
	
	
	/**
	 * 
	 * @var StringUtils
	 */
	protected $utils;
	
	protected function setUp() {
		$this->utils = new StringUtils();
	}
	
	
	
	public function testGetFilters() {
		$result = $this->utils->getFilters();
	
		$this->assertArrayHasKey(self::TWIG_FILTER, $result);
	}
	
	
	
	public function testGetCleanEmptyName() {
		$this->getCleanName(self::EMPTY_NAME, self::EMPTY_NAME);
	}
	
	public function testGetCleanCleanName() {
		$this->getCleanName(self::CLEAN_NAME, self::CLEAN_NAME);
	}
	
	public function testGetCleanDityName() {
		$this->getCleanName(self::CLEAN_NAME, self::DIRTY_NAME);
	}
	
	public function testGetCleanDoublePauseName() {
		$this->getCleanName(self::CLEAN_DOUBLE_PAUSE_NAME, self::DIRTY_DOUBLE_PAUSE_NAME);
	}
	
	
	
	public function testGetCleanEmptyPath() {
		$this->getCleanPath(self::EMPTY_PATH, self::EMPTY_PATH);
	}
	
	public function testGetCleanCleanPath() {
		$this->getCleanPath(self::CLEAN_PATH, self::CLEAN_PATH);
	}
	
	public function testGetCleanDityPath() {
		$this->getCleanPath(self::CLEAN_PATH, self::DIRTY_PATH);
	}
	
	public function testGetCleanDoublePausePath() {
		$this->getCleanPath(self::CLEAN_DOUBLE_PAUSE_PATH, self::DIRTY_DOUBLE_PAUSE_PATH);
	}
	
	public function testGetCleanDoubleSlashPath() {
		$this->getCleanPath(self::CLEAN_DOUBLE_SLASH_PATH, self::DIRTY_DOUBLE_SLASH_PATH);
	}
	
	
	
	protected function getCleanName($expected, $provided) {
		$result = StringUtils::getCleanName($provided);
	
		$this->assertSame($expected, $result);
	}
	
	protected function getCleanPath($expected, $provided) {
		$result = StringUtils::getCleanPath($provided);
	
		$this->assertSame($expected, $result);
	}
}
