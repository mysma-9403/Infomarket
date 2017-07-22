<?php

namespace Tests\AppBundle\Form\Other;

use AppBundle\Entity\Other\ArticleTagAssignments;
use AppBundle\Form\Other\ArticleTagAssignmentsType;
use Tests\AppBundle\Form\Base\BaseTypeTest;

class ArticleTagAssignmentsTypeTest extends BaseTypeTest {
	
	const TAGS_STRING = 'tag1, tag2, tag3';
	
	const TAG_1 = 101;
	const TAG_2 = 102;
	const TAG_3 = 103;
	
	const TAG_SELECTED = [self::TAG_1, self::TAG_2];
	const TAG_CHOICES = [self::TAG_1, self::TAG_2, self::TAG_3];
	
	
	protected function assertEntity($entity) {
		/** @var ArticleTagAssignments $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::TAGS_STRING, $entity->getTagsString());
		
		$this->assertArray(self::TAG_SELECTED, $entity->getTags());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['tagsString'] = self::TAGS_STRING;
		$data['tags'] = self::TAG_SELECTED;
		
		return $data;
	}
	
	protected function getFormActions() {
		$actions = parent::getFormActions();
	
		$actions['submit'] = 'submit';
	
		return $actions;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('tags')] = self::TAG_CHOICES;
		
		return $options;
	}
	
	protected function getFormType() {
		return ArticleTagAssignmentsType::class;
	}
	
	protected function getEntity() {
		return new ArticleTagAssignments();
	}
}