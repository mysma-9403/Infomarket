<?php

namespace AppBundle\Form;

use AppBundle\Form\Base\SimpleEntityListType;
use AppBundle\Entity\Lists\CategoryList;

class CategoryListType extends SimpleEntityListType {
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return 'AppBundle:Category';
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityListClass() {
		return CategoryList::class;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityListName() {
		return 'category_list';
	}
}