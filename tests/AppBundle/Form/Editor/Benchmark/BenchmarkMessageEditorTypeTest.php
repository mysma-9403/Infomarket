<?php

namespace Tests\AppBundle\Form\Editor\Benchmark;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Form\Editor\Benchmark\BenchmarkMessageEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Base\EditorTypeTest;

class BenchmarkMessageEditorTypeTest extends EditorTypeTest {
	
	const NAME = 'Test name';
	const CONTENT = 'Test content';
	
	
	
	protected function getExtensions() {
		$type = new BenchmarkMessageEditorType();
		
		return array(new PreloadedExtension(array($this->getCKEditor(), $type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var BenchmarkMessage $entity */
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::CONTENT, $entity->getContent());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		$data['content'] = self::CONTENT;
		
		return $data;
	}
	
	protected function getFormType() {
		return BenchmarkMessageEditorType::class;
	}
	
	protected function getEntity() {
		return new BenchmarkMessage();
	}
}