<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Entity\Branch;
use AppBundle\Form\Editor\Assignments\MagazineBranchAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class MagazineBranchAssignmentEditorTypeTest extends TypeTestCase {
		
	const MAGAZINE_ID = 100;
	const MAGAZINE_NAME = 'Test magazine';
	
	const BRANCH_ID = 100;
	const BRANCH_NAME = 'Test branch';
	
	const FORM_DATA = [
			'magazine' => self::MAGAZINE_ID,
			'branch' => self::BRANCH_ID
	];
	
	const FORM_MAGAZINE_LIST = ['Test magazine' => self::MAGAZINE_ID];
	const FORM_BRANCH_LIST = ['Test branch' => self::BRANCH_ID];
	
	const FORM_OPTIONS = [
			'magazine' => self::FORM_MAGAZINE_LIST,
			'branch' => self::FORM_BRANCH_LIST
	];
	
	
	
	private $magazineTransformer;
	
	private $branchTransformer;
	
	
	
	protected function setUp() {
		$this->magazineTransformer = $this->getMagazineTransformerMock();
		$this->branchTransformer = $this->getBranchTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new MagazineBranchAssignmentEditorType($this->magazineTransformer, $this->branchTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(MagazineBranchAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new MagazineBranchAssignment();
		$form = $this->factory->create(MagazineBranchAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::MAGAZINE_ID, $assignment->getMagazine()->getId());
		$this->assertSame(self::MAGAZINE_NAME, $assignment->getMagazine()->getName());
		$this->assertSame(self::BRANCH_ID, $assignment->getBranch()->getId());
		$this->assertSame(self::BRANCH_NAME, $assignment->getBranch()->getName());
	}
	
	
	
	private function getMagazineTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getMagazine());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MAGAZINE_ID);
	
		return $mock;
	}
	
	private function getBranchTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getBranch());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MAGAZINE_ID);
	
		return $mock;
	}
	
	
	private function getMagazine() {
		$mock = new Magazine();
		$mock->setId(self::MAGAZINE_ID);
		$mock->setName(self::MAGAZINE_NAME);
		
		return $mock;
	}
	
	private function getBranch() {
		$mock = new Branch();
		$mock->setId(self::BRANCH_ID);
		$mock->setName(self::BRANCH_NAME);
	
		return $mock;
	}
}