<?php

namespace AppBundle\Factory\Admin\Import\NewsletterUser;

use AppBundle\Validation\ParamValidation;

class PreparedEntryFactory {
	
	/**
	 *
	 * @var ImportErrorFactory
	 */
	protected $errorFactory;
	
	/**
	 * 
	 * @var ParamValidation
	 */
	protected $mailValidation;
	
	public function __construct(ImportErrorFactory $errorFactory, ParamValidation $mailValidation) {
		$this->errorFactory = $errorFactory;
		$this->mailValidation = $mailValidation;
	}
	
	public function getEntries($fileEntries) {
		$entries = array();
	
		$lineNumber = 0;
		foreach ($fileEntries as $fileEntry) {
			$lineNumber++;
	
			$rowEntries = $this->getRowEntries($fileEntry, $lineNumber);
			if($rowEntries) {
				foreach ($rowEntries as $entry) {
					if($entry) $entries[] = $entry;
				}
			}
		}
	
		return $entries;
	}
	
	public function getRowEntries($fileEntry, $lineNumber) {
		$entries = array();
	
		if(count($fileEntry) <= 0) return null;
	
		$mail = count($fileEntry) > 0 ? $fileEntry[0] : '';
		$mail = trim($mail);
		
		if(strlen($mail) <= 0) return null;
		
		$rowSubscribed = true;
		if(count($fileEntry) > 1) {
			$value = $fileEntry[1];
			if($value && $value != '0' && $value != '-' && $value != 'false') $rowSubscribed = false;
		}
		
		$temp = explode(';', $mail);
		$mails = array();
		foreach ($temp as $mail) {
			$mail = trim($mail);
			if($mail && strlen($mail) > 0) {
				$mails = array_merge($mails, explode(',', $mail));
			}
		}
		
		foreach ($mails as $mail) {
			$entry = array();
			$errors = array();
			
			$mail = trim($mail);
			$mail = strtolower($mail);
			
			if($mail && strlen($mail) > 0) {
				
				$subscribed = $rowSubscribed;
				
				$searchLength = strlen('rezygnacja_');
				
				$mailLength = strlen($mail);
				if($searchLength < $mailLength) {
					$part = substr($mail, 0, $searchLength);
					if($part == 'rezygnacja_' || $part == 'rezygnacja-' || $part == 'rezygnacja ') {
						$mail = substr($mail, $searchLength);
						$mail = trim($mail);
						$subscribed = false;
					}
				}
				
				$mailLength = strlen($mail);
				if($searchLength < $mailLength) {
					$start = $mailLength - $searchLength;
					$part = substr($mail, $start);
					if($part == '_rezygnacja' || $part == '-rezygnacja' || $part == ' rezygnacja') {
						$mail = substr($mail, 0, $start);
						$mail = trim($mail);
						$subscribed = false;
					}
				}
				
				
				$searchLength = strlen('rez_');
					
				$mailLength = strlen($mail);
				if($searchLength < $mailLength) {
					$part = substr($mail, 0, $searchLength);
					if($part == 'rez_' || $part == 'rez-' || $part == 'rez ') {
						$mail = substr($mail, $searchLength);
						$mail = trim($mail);
						$subscribed = false;
					}
				}
					
				$mailLength = strlen($mail);
				if($searchLength < $mailLength) {
					$start = $mailLength - $searchLength;
					$part = substr($mail, $start);
					if($part == '_rez' || $part == '-rez' || $part == ' rez') {
						$mail = substr($mail, 0, $start);
						$mail = trim($mail);
						$subscribed = false;
					}
				}
				
				if(!$this->mailValidation->isValid($mail)) {
					$errors[] = $this->errorFactory->createInvalidMailError($lineNumber, $mail);
				}
				
				$entry['lineNumber'] = $lineNumber;
				$entry['mail'] = $mail;
				$entry['subscribed'] = $subscribed;
				$entry['duplicate'] = false;
				$entry['errors'] = $errors;
				
				$entries[] = $entry;
			}
		}
	
		return $entries;
	}
}