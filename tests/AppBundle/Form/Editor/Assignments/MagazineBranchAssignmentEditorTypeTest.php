<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Form\Editor\Assignments\MagazineBranchAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Base\BaseEntityEditorTypeTest;

class MagazineBranchAssignmentEditorTypeTest extends BaseEntityEditorTypeTest {
		
	const MAGAZINE_ID = 100;
	const MAGAZINE_NAME = 'Test magazine';
	const MAGAZINE_CHOICES = ['Test magazine' => self::MAGAZINE_ID];
	
	const BRANCH_ID = 100;
	const BRANCH_NAME = 'Test branch';
	const BRANCH_CHOICES = ['Test branch' => self::BRANCH_ID];
	
	
	
	private $magazineTransformer;
	
	private $branchTransformer;
	
	
	
	protected function setUp() {
		$this->magazineTransformer = $this->getEntityTransformerMock($this->getMagazine(), self::MAGAZINE_ID);
		$this->branchTransformer = $this->getEntityTransformerMock($this->getBranch(), self::BRANCH_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new MagazineBranchAssignmentEditorType($this->magazineTransformer, $this->branchTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var MagazineBranchAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::MAGAZINE_ID, $entity->getMagazine()->getId());
		$this->assertSame(self::MAGAZINE_NAME, $entity->getMagazine()->getName());
		
		$this->assertSame(self::BRANCH_ID, $entity->getBranch()->getId());
		$this->assertSame(self::BRANCH_NAME, $entity->getBranch()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['magazine'] = self::MAGAZINE_ID;
		$data['branch'] = self::BRANCH_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('magazine')] = self::MAGAZINE_CHOICES;
		$options[self::getChoicesName('branch')] = self::BRANCH_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return MagazineBranchAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new MagazineBranchAssignment();
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