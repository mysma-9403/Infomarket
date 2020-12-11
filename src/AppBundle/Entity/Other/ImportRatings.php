<?php

namespace AppBundle\Entity\Other;

class ImportRatings {

	/**
	 *
	 * @var string
	 */
	private $importFile;

	public function setImportFile($importFile) {
		$this->importFile = $importFile;
		
		return $this;
	}

	public function getImportFile() {
		return $this->importFile;
	}
}
