<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Branch;
use AppBundle\Form\Editor\Admin\Main\BranchEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEditorTypeTest;

class BranchEditorTypeTest extends ImageEditorTypeTest {

	const NAME = 'Test name';

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	const ICON = 'fa-camera';

	const COLOR = 'fa0045';

	const ORDER_NUMBER = 3;

	const CONTENT = 'Test content';

	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var Branch $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
		
		$this->assertSame(self::ICON, $entity->getIcon());
		$this->assertSame(self::COLOR, $entity->getColor());
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
		$this->assertSame(self::CONTENT, $entity->getContent());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		
		$data['icon'] = self::ICON;
		$data['color'] = self::COLOR;
		$data['orderNumber'] = self::ORDER_NUMBER;
		$data['content'] = self::CONTENT;
		
		return $data;
	}

	protected function getFormType() {
		return BranchEditorType::class;
	}

	protected function getEntity() {
		return new Branch();
	}
}