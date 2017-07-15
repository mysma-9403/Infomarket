<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Form\Editor\Main\BenchmarkMessageEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Base\EditorTypeTest;

class BenchmarkMessageEditorTypeTest extends EditorTypeTest {
	
	const STATE = 2;
	const NAME = 'Test name';
	const CONTENT = 'Test content';
	
	
	const STATE_CHOICES = ['Test state' => self::STATE];
	
	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}
	
	
	protected function assertEntity($entity) {
		/** @var BenchmarkMessage $entity */
		$this->assertSame(self::STATE, $entity->getState());
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::CONTENT, $entity->getContent());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['state'] = self::STATE;
		$data['name'] = self::NAME;
		$data['content'] = self::CONTENT;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('state')] = self::STATE_CHOICES;
		
		return $options;
	}
	
	protected function getFormType() {
		return BenchmarkMessageEditorType::class;
	}
	
	protected function getEntity() {
		return new BenchmarkMessage();
	}
}