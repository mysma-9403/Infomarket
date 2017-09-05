<?php

namespace AppBundle\Factory\Admin\Import;

use AppBundle\Factory\Admin\ErrorFactory;
use Symfony\Component\Debug\Exception\ContextErrorException;

class FileEntryFactory {

	/**
	 *
	 * @var ErrorFactory
	 */
	protected $errorFactory;

	public function __construct(ErrorFactory $errorFactory) {
		$this->errorFactory = $errorFactory;
	}

	public function getEntries($fileName) {
		$rows = array ();
		$errors = array ();
		
		$fileName = urldecode($fileName);
		
		try {
			$file = fopen('../web' . $fileName, 'r');
		} catch (ContextErrorException $ex) {
			$errors[] = $this->errorFactory->createCannotOpenFileError('"' . $fileName . '"');
			$rows['errors'] = $errors;
			return $rows;
		}
		
		if ($file === false) {
			$errors[] = $this->errorFactory->createCannotOpenFileError($fileName);
			$rows['errors'] = $errors;
			return $rows;
		}
		
		while (($row = fgetcsv($file, 1024, ';')) !== FALSE) {
			$rows[] = $row;
		}
		
		fclose($file);
		
		$rows['errors'] = $errors;
		return $rows;
	}
}