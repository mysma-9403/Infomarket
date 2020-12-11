<?php

namespace AppBundle\Factory\Admin\Import\NewsletterUser;

use AppBundle\Factory\Admin\ErrorFactory;

class ImportErrorFactory extends ErrorFactory {

	public function createInvalidMailError($number, $mail) {
		$lineMsg = $this->createLineError($number);
		
		$errorMsg = $this->translator->trans('error.newsletterUser.import.invalidMail');
		$errorMsg = str_replace('%mail%', '<strong>' . $mail . '</strong>', $errorMsg);
		
		return $lineMsg . $errorMsg;
	}

	public function createInconsistentDataError($prevNumber, $nextNumber, $mail) {
		$lineMsg = $this->createLinesError($prevNumber, $nextNumber);
		
		$errorMsg = $this->translator->trans('error.newsletterUser.import.inconsistentData');
		$errorMsg = str_replace('%mail%', $mail, $errorMsg);
		
		return $lineMsg . $errorMsg;
	}

	public function createSaveFailedError($number, $name) {
		$lineMsg = $this->createLineError($number);
		
		$errorMsg = $this->translator->trans('error.newsletterUser.import.saveFailed');
		$errorMsg = str_replace('%name%', $name, $errorMsg);
		
		return $lineMsg . $errorMsg;
	}
}