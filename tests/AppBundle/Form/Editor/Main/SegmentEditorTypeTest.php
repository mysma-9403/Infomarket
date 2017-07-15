<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\Segment;
use AppBundle\Form\Editor\Main\SegmentEditorType;
use Tests\AppBundle\Form\Editor\Base\ImageEntityEditorTypeTest;

class SegmentEditorTypeTest extends ImageEntityEditorTypeTest {
	
	const SUBNAME = 'Test subname';
	const COLOR = 'ff9900';
	const ORDER_NUMBER = 17;
	
	
	
	protected function assertEntity($entity) {
		/** @var Segment $entity */
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		$this->assertSame(self::COLOR, $entity->getColor());
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['subname'] = self::SUBNAME;
		$data['color'] = self::COLOR;
		$data['orderNumber'] = self::ORDER_NUMBER;
		
		return $data;
	}
	
	protected function getFormType() {
		return SegmentEditorType::class;
	}
	
	protected function getEntity() {
		return new Segment();
	}
}