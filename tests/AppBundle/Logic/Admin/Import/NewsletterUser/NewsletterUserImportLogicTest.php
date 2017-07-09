<?php

namespace Tests\AppBundle\Logic\Admin\Import\NewsletterUser;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Logic\Admin\NewsletterUserImportLogic;
use AppBundle\Factory\Admin\NewsletterUserImportErrorFactory;

class ImportLogicTest extends WebTestCase {
	
	public function testImport() {
	}
	
	protected function getPreparedRowEntries() {
		new NewsletterUserImportErrorFactory ( $translator );
		new NewsletterUserImportLogic ( null, $errorFactory );
	}
}
