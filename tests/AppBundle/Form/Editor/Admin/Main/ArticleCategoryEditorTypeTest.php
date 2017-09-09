<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Form\Editor\Admin\Main\ArticleCategoryEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEditorTypeTest;

class ArticleCategoryEditorTypeTest extends ImageEditorTypeTest {

	const NAME = 'Test name';

	const SUBNAME = 'Test subname';

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	const FEATURED = true;

	const ORDER_NUMBER = 99;

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var ArticleCategory $entity */
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
		$this->assertSame(self::FEATURED, $entity->getFeatured());
		
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		$data['subname'] = self::SUBNAME;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		$data['featured'] = self::FEATURED;
		
		$data['orderNumber'] = self::ORDER_NUMBER;
		
		return $data;
	}

	protected function getFormType() {
		return ArticleCategoryEditorType::class;
	}

	protected function getEntity() {
		return new ArticleCategory();
	}
}