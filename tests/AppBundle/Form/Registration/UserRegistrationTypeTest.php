<?php

namespace Tests\AppBundle\Form\Registration;


use AppBundle\Entity\User;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\Tests\Extension\Core\Type\FormTypeTest;

class UserRegistrationTypeTest extends FormTypeTest {
	
	const FORENAME = 'Forename';
	const SURNAME = 'Surname';
	const STREET = 'ul. Testowa 15';
	const ZIP_CODE = '05-997';
	const CITY = 'Krakow';
	
	const DIGITAL_SUBSCRIPTION = true;
	const PHYSICAL_SUBSCRIPTION = true;
	const DATA_PROCESSING_AGREEMENT = true;
	
	
	
	protected function assertEntity($entity) {
		/** @var User $entity */
		$this->assertSame(self::FORENAME, $entity->getForename());
		$this->assertSame(self::SURNAME, $entity->getSurname());
		$this->assertSame(self::STREET, $entity->getStreet());
		$this->assertSame(self::ZIP_CODE, $entity->getZipCode());
		$this->assertSame(self::CITY, $entity->getCity());
		
		$this->assertSame(self::DIGITAL_SUBSCRIPTION, $entity->getDigitalSubscription());
		$this->assertSame(self::PHYSICAL_SUBSCRIPTION, $entity->getPhysicalSubscription());
		$this->assertSame(self::DATA_PROCESSING_AGREEMENT, $entity->getDataProcessingAgreement());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['forename'] = self::FORENAME;
		$data['surname'] = self::SURNAME;
		$data['street'] = self::STREET;
		$data['zipCode'] = self::ZIP_CODE;
		$data['city'] = self::CITY;
		
		$data['digitalSubscription'] = self::DIGITAL_SUBSCRIPTION;
		$data['physicalSubscription'] = self::PHYSICAL_SUBSCRIPTION;
		$data['dataProcessingAgreement'] = self::DATA_PROCESSING_AGREEMENT;
		
		return $data;
	}
	
	protected function getFormType() {
		return RegistrationFormType::class;
	}
	
	protected function getEntity() {
		return new User();
	}
}