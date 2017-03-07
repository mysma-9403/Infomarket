<?php

namespace AppBundle\Factory\Admin;

use Symfony\Component\Translation\DataCollectorTranslator;

class ErrorFactory {
	
	/**
	 *
	 * @var DataCollectorTranslator
	 */
	protected $translator;
	
	
	
	public function __construct(DataCollectorTranslator $translator) {
		$this->translator = $translator;
	}
	
	public function createLineError($lineNumber) {
		$lineMsg = $this->translator->trans('error.import.lineNumber');
		$lineMsg = str_replace('%number%', $lineNumber, $lineMsg);
	
		return $lineMsg;
	}
	
	public function createLinesError($prevNumber, $nextNumber) {
		$lineMsg = $this->translator->trans('error.import.lineNumbers');
		$lineMsg = str_replace('%prevNumber%', $prevNumber, $lineMsg);
		$lineMsg = str_replace('%nextNumber%', $nextNumber, $lineMsg);
	
		return $lineMsg;
	}
}