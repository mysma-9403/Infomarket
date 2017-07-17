<?php

namespace Tests\AppBundle\Form\Base;

use Ivory\CKEditorBundle\Model\ConfigManagerInterface;
use Ivory\CKEditorBundle\Model\PluginManagerInterface;
use Ivory\CKEditorBundle\Model\StylesSetManagerInterface;
use Ivory\CKEditorBundle\Model\TemplateManagerInterface;
use Symfony\Component\Form\Test\TypeTestCase;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use AppBundle\Form\Base\BaseType;

abstract class BaseTypeTest extends TypeTestCase {
	
	public function testViewProperties()
	{
		$form = $this->factory->create($this->getFormType());
	
		$view = $form->createView();
	
		foreach (array_keys($this->getFormData()) as $key)
			$this->assertArrayHasKey($key, $view->children);
	
		foreach (array_keys($this->getFormActions()) as $key)
			$this->assertArrayHasKey($key, $view->children);
			
		$this->assertCount($this->getFormFieldsCount(), $view->children);
	}
	
	public function testSubmitValidData()
	{
		$entity = $this->getEntity();
		$form = $this->factory->create($this->getFormType(), $entity, $this->getFormOptions());
	
		$form->submit($this->getFormData());
	
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($entity, $form->getData());
		
		$this->assertEntity($entity);
	}
	
	
	
	protected function assertEntity($entity) { }
	
	protected function assertDate($expected, \DateTime $actual) {
		$this->assertSame($expected, $actual->format('m/Y'));
	}
	
	protected function assertDateTime($expected, \DateTime $actual) {
		$this->assertSame($expected, $actual->format('d/m/Y H:i'));
	}
	
	protected function assertArray($expected, $actual) {
		foreach($expected as $expectedItem) {
			$this->assertContains($expectedItem, $actual);
		}
		
		$this->assertSameSize($expected, $actual);
	}
	
	
	
	protected function getFormData() {
		return [];
	}
	
	protected function getFormActions() {
		return [];
	}
	
	protected function getFormOptions() {
		return [];
	}
	
	protected function getFormFieldsCount() {
		return count($this->getFormData()) + count($this->getFormActions());
	}
	
	abstract protected function getFormType();
	
	abstract protected function getEntity();
	
	
	
	protected function getCKEditor() {
		$configManager = $this->getMockBuilder ( ConfigManagerInterface::class )->disableOriginalConstructor ()->getMock ();
		$pluginManager = $this->getMockBuilder ( PluginManagerInterface::class )->disableOriginalConstructor ()->getMock ();
		$stylesSetManager = $this->getMockBuilder ( StylesSetManagerInterface::class )->disableOriginalConstructor ()->getMock ();
		$templateManager = $this->getMockBuilder ( TemplateManagerInterface::class )->disableOriginalConstructor ()->getMock ();
	
		$type = new CKEditorType($configManager, $pluginManager, $stylesSetManager, $templateManager);
	
		return $type;
	}
	
	
	
	protected function getEntityTransformerMock($entity, $id) {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($entity);
		$mock->expects ($this->any())->method ( 'transform' )->willReturn($id);
	
		return $mock;
	}
	
	protected static function getChoicesName($field) {
		return BaseType::getChoicesName($field);
	}
}