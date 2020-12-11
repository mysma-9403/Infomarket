<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Utils\FormUtils;
use PHPUnit\Framework\TestCase;

class FormUtilsTest extends TestCase {

	const CHOICE_VALUE = 1;

	const CHOICE_INDEX = 0;

	const CHOICE_KEY = '1 test choice';

	const CHOICE_LABEL = 'test choice';

	const NO_SPACE_CHOICE_KEY = 'test_choice';

	const NO_SPACE_CHOICE_LABEL = ' ';

	const EMPTY_CHOICE_KEY = '';

	const EMPTY_CHOICE_LABEL = ' ';

	public function testGetChoiceLabel() {
		$result = FormUtils::getChoiceLabel(self::CHOICE_VALUE, self::CHOICE_KEY, self::CHOICE_INDEX);
		
		$this->assertSame(self::CHOICE_LABEL, $result);
	}

	public function testGetNoSpaceChoiceLabel() {
		$result = FormUtils::getChoiceLabel(self::CHOICE_VALUE, self::NO_SPACE_CHOICE_KEY, self::CHOICE_INDEX);
		
		$this->assertSame(self::NO_SPACE_CHOICE_LABEL, $result);
	}

	public function testGetEmptyChoiceLabel() {
		$result = FormUtils::getChoiceLabel(self::CHOICE_VALUE, self::EMPTY_CHOICE_KEY, self::CHOICE_INDEX);
		
		$this->assertSame(self::EMPTY_CHOICE_LABEL, $result);
	}
}
