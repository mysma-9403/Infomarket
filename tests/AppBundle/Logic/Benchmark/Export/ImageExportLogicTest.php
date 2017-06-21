<?php

namespace Tests\AppBundle\Logic\Benchmark\Export;

use AppBundle\Logic\Benchmark\Export\ImageExportLogic;
use PHPUnit\Framework\TestCase;

class ImageExportLogicTest extends TestCase {
	/**
	 *
	 * @var ImageExportLogic $imageExportLogic
	 */
	protected $imageExportLogic;
	public function __construct() {
		$this->imageExportLogic = new ImageExportLogic ();
	}
	public function testGivenScriptThenScriptIsRemoved() {
		$html = "<html><script src=\"js/some-java-script.js\"></script></html>";
		$expected = "<html></html>";
		
		$result = $this->imageExportLogic->clean ( $html );
		
		$this->assertEquals ( $expected, $result );
	}
	public function testGivenLinkThenLinkIsRemoved() {
		$html = "<html><link src=\"css/stylesheet.css\"/><body><a src=\"/src/img/aaa.png\">link</a></body></html>";
		$expected = "<html><link src=\"css/stylesheet.css\"/><body></body></html>";
		
		$result = $this->imageExportLogic->clean ( $html );
		
		$this->assertEquals ( $expected, $result );
	}
	public function testGivenLocalSourceThenLocalSourceIsExtended() {
		$html = "<img src=\"/src/img/aaa.png\"/>";
		$expected = "<img src=\"http://infomarket.edu.pl/src/img/aaa.png\"/>";
		
		$result = $this->imageExportLogic->clean ( $html );
		
		$this->assertEquals ( $expected, $result );
	}
	public function testGivenTableThenReplaceBodyWithTable() {
		$html = "<html><header>header content</header><body>body content <table>table content</table> body content</body></html>";
		$expected = "<html><header>header content</header><body><table>table content</table></body></html>";
		
		$result = $this->imageExportLogic->clean ( $html );
		
		$this->assertEquals ( $expected, $result );
	}
}
