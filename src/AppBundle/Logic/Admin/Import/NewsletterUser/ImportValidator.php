<?php

namespace AppBundle\Logic\Admin\Import\NewsletterUser;

use AppBundle\Factory\Admin\ErrorFactory;
use AppBundle\Factory\Admin\Import\NewsletterUser\ImportErrorFactory;

class ImportValidator {
	
	/**
	 *
	 * @var ImportErrorFactory
	 */
	protected $errorFactory;
	
	
	
	public function __construct(ImportErrorFactory $errorFactory) {
		$this->errorFactory = $errorFactory;
	}
	
	public function validateEntries($preparedEntries) {
		$count = count($preparedEntries);
	
		for($i = 0; $i < $count; $i++) {
			$prevEntry = $preparedEntries[$i];
			
			if(!$prevEntry['duplicate']) {
				$errors = array();
				$prevMail = $prevEntry['mail'];
					
				for($j = $i+1; $j < $count; $j++) {
					$nextEntry = $preparedEntries[$j];
		
					$nextMail = $nextEntry['mail'];
		
					if($prevMail == $nextMail) {	
						$prevSubscribed = $prevEntry['subscribed'];
						$nextSubscribed = $nextEntry['subscribed'];
							
						if($prevSubscribed != $nextSubscribed) {
							$prevNumber = $prevEntry['lineNumber'];
							$nextNumber = $nextEntry['lineNumber'];
							$errors[] = $this->errorFactory->createInconsistentDataError($prevNumber, $nextNumber, $prevMail);
						}
						
						$nextEntry['duplicate'] = true;
						$preparedEntries[$j] = $nextEntry;
					}
				}
					
				$prevEntry['errors'] = $errors;
				$preparedEntries[$i] = $prevEntry;
			}
		}
	
		return $preparedEntries;
	}
}