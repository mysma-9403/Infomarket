<?php

namespace AppBundle\Factory\Admin;

class ErrorFactory {

	/**
	 *
	 * @var mixed - different on dev and prod environments
	 */
	protected $translator;

	public function __construct($translator) {
		$this->translator = $translator;
	}

	public function createCannotOpenFileError($fileName) {
		$message = $this->translator->trans('error.import.cannotOpenFile');
		
		$message = $this->insertParam($message, '%fileName%', $fileName);
		
		return $message;
	}

	public function createLineError($lineNumber) {
		$message = $this->translator->trans('error.import.lineNumber');
		
		$message = $this->insertParam($message, '%number%', $lineNumber);
		
		return $message;
	}

	public function createLinesError($prevNumber, $nextNumber) {
		$message = $this->translator->trans('error.import.lineNumbers');
		
		$message = $this->insertParam($message, '%prevNumber%', $prevNumber);
		$message = $this->insertParam($message, '%nextNumber%', $nextNumber);
		
		return $message;
	}

	protected function insertParam($message, $name, $value) {
		$value = trim($value);
		
		if ($value && strlen($value) > 0) {
			$value = '<strong>' . $value . '</strong>';
		} else {
			$value = '';
		}
		
		return str_replace($name, $value, $message);
	}
}