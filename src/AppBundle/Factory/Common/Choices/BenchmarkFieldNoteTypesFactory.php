<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Factory\Common\Choices\Base\AbstractChoicesFactory;

class BenchmarkFieldNoteTypesFactory extends AbstractChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				BenchmarkField::getNoteTypeName(BenchmarkField::NONE_NOTE_TYPE) => BenchmarkField::NONE_NOTE_TYPE,
				BenchmarkField::getNoteTypeName(BenchmarkField::ASC_NOTE_TYPE) => BenchmarkField::ASC_NOTE_TYPE,
				BenchmarkField::getNoteTypeName(BenchmarkField::DESC_NOTE_TYPE) => BenchmarkField::DESC_NOTE_TYPE,
				BenchmarkField::getNoteTypeName(BenchmarkField::ENUM_NOTE_TYPE) => BenchmarkField::ENUM_NOTE_TYPE
		];
	}
	
}