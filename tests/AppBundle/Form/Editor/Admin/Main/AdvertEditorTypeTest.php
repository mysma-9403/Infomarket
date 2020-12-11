<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Advert;
use AppBundle\Form\Editor\Admin\Main\AdvertEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEditorTypeTest;

class AdvertEditorTypeTest extends ImageEditorTypeTest {

	const NAME = 'Test name';

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	const LOCATION = 13;

	const DATE_FROM = '19/10/1987 12:00';

	const DATE_TO = '21/11/2027 13:45';

	const LINK = 'www.krk-dev.com';

	const SHOW_LIMIT = 3000;

	const CLICK_LIMIT = 200;

	const LOCATION_CHOICES = ['Test location' => self::LOCATION];

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var Advert $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
		
		$this->assertSame(self::LOCATION, $entity->getLocation());
		
		$this->assertDateTime(self::DATE_FROM, $entity->getDateFrom());
		$this->assertDateTime(self::DATE_TO, $entity->getDateTo());
		
		$this->assertSame(self::LINK, $entity->getLink());
		
		$this->assertSame(self::SHOW_LIMIT, $entity->getShowLimit());
		$this->assertSame(self::CLICK_LIMIT, $entity->getClickLimit());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		
		$data['location'] = self::LOCATION;
		
		$data['dateFrom'] = self::DATE_FROM;
		$data['dateTo'] = self::DATE_TO;
		
		$data['link'] = self::LINK;
		
		$data['showLimit'] = self::SHOW_LIMIT;
		$data['clickLimit'] = self::CLICK_LIMIT;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('location')] = self::LOCATION_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return AdvertEditorType::class;
	}

	protected function getEntity() {
		return new Advert();
	}
}