<?php

namespace AppBundle\Entity\Other;

class ImportNewsletterUsers {

	/**
	 *
	 * @var string
	 */
	private $importFile;

	/**
	 *
	 * @var array
	 */
	private $newsletterGroups;

	public function setImportFile($importFile) {
		$this->importFile = $importFile;
		
		return $this;
	}

	public function getImportFile() {
		return $this->importFile;
	}

	public function setNewsletterGroups($newsletterGroups) {
		$this->newsletterGroups = $newsletterGroups;
		
		return $this;
	}

	public function getNewsletterGroups() {
		return $this->newsletterGroups;
	}
}
