<?php

namespace Tests\AppBundle\Form\Editor\Benchmark;

use AppBundle\Entity\Main\BenchmarkQuery;
use AppBundle\Form\Editor\Benchmark\BenchmarkQueryEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Base\EditorTypeTest;

class BenchmarkQueryEditorTypeTest extends EditorTypeTest {
	
	const NAME = 'Test name';
	const CONTENT = 'Test content';
	const ARCHIVED = true;
	
	
	
	protected function getExtensions() {
		$type = new BenchmarkQueryEditorType();
		
		return array(new PreloadedExtension(array($this->getCKEditor(), $type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var BenchmarkQuery $entity */
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::CONTENT, $entity->getContent());
		$this->assertSame(self::ARCHIVED, $entity->getArchived());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		$data['content'] = self::CONTENT;
		$data['archived'] = self::ARCHIVED;
		
		return $data;
	}
	
	protected function getFormType() {
		return BenchmarkQueryEditorType::class;
	}
	
	protected function getEntity() {
		return new BenchmarkQuery();
	}
}