<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Form\Editor\Main\ArticleCategoryEditorType;
use Tests\AppBundle\Form\Editor\Base\ImageEntityEditorTypeTest;

class ArticleCategoryEditorTypeTest extends ImageEntityEditorTypeTest {
	
	const FEATURED = true;
	const ORDER_NUMBER = 99;
	const SUBNAME = 'Test subname';
	
	
	protected function assertEntity($entity) {
		/** @var ArticleCategory $entity */
		$this->assertSame(self::FEATURED, $entity->getFeatured());
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
		$this->assertSame(self::SUBNAME, $entity->getSubname());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['featured'] = self::FEATURED;
		$data['orderNumber'] = self::ORDER_NUMBER;
		$data['subname'] = self::SUBNAME;
		
		return $data;
	}
	
	protected function getFormType() {
		return ArticleCategoryEditorType::class;
	}
	
	protected function getEntity() {
		return new ArticleCategory();
	}
}