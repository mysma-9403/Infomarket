<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Brand;
use AppBundle\Form\Editor\Admin\Main\BrandEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEditorTypeTest;

class BrandEditorTypeTest extends ImageEditorTypeTest {

	const NAME = 'Test name';

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	const WWW = 'http://krk-dev.com';

	const CONTENT = 'Test content';

	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var Brand $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
		
		$this->assertSame(self::WWW, $entity->getWww());
		$this->assertSame(self::CONTENT, $entity->getContent());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		
		$data['www'] = self::WWW;
		$data['content'] = self::CONTENT;
		
		return $data;
	}

	protected function getFormType() {
		return BrandEditorType::class;
	}

	protected function getEntity() {
		return new Brand();
	}
}