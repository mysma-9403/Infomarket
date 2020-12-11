<?php

namespace AppBundle\Factory\Common\Choices\Enum;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Factory\Common\Choices\Base\TwigChoicesFactory;

class BenchmarkFieldNoteTypesFactory extends TwigChoicesFactory {

	public function __construct() {
		$this->items['label.benchmarkField.noteType.none'] = BenchmarkField::NONE_NOTE_TYPE;
		$this->items['label.benchmarkField.noteType.ascending'] = BenchmarkField::ASC_NOTE_TYPE;
		$this->items['label.benchmarkField.noteType.descending'] = BenchmarkField::DESC_NOTE_TYPE;
		$this->items['label.benchmarkField.noteType.enum'] = BenchmarkField::ENUM_NOTE_TYPE;
	}

	protected function getTwigFunctionName() {
		return 'benchmarkFieldNoteTypeName';
	}
}