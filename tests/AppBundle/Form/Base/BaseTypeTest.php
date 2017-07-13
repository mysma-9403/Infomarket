<?php

namespace Tests\AppBundle\Form\Base;

use Symfony\Component\Form\Test\TypeTestCase;

abstract class BaseTypeTest extends TypeTestCase {
	
	public function testViewProperties()
	{
		$form = $this->factory->create($this->getFormType());
	
		$view = $form->createView();
	
		foreach (array_keys($this->getFormData()) as $key)
			$this->assertArrayHasKey($key, $view->children);
	
		$this->assertCount($this->getFormFieldsCount(), $view->children);
	}
	
	public function testSubmitValidData()
	{
		$entity = $this->getEntity();
		$form = $this->factory->create($this->getFormType(), $entity, $this->getFormOptons());
	
		$form->submit($this->getFormData());
	
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($entity, $form->getData());
		
		$this->assertEntity($entity);
	}
	
	protected function assertEntity($entity) { }
	
	protected function getFormData() {
		return [];
	}
	
	protected function getFormOptons() {
		return [];
	}
	
	protected function getFormFieldsCount() {
		return count($this->getFormData());
	}
	
	abstract protected function getFormType();
	
	abstract protected function getEntity();
}