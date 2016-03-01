<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Category;
use AppBundle\Entity\Lists\CategoryList;
use AppBundle\Form\CategoryType;
use AppBundle\Form\CategoryListType;

class CategoryController extends SimpleEntityController {
	
	/**
	 * {@inheritDoc}
	 */
	protected function getEntityType() {
		return 'AppBundle:Category';
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getEntityClass() {
		return Category::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getEntityListClass() {
		return CategoryList::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getFormClass() {
		return CategoryType::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getListFormClass() {
		return CategoryListType::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getTwigName() {
		return 'category';
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function createNewList() {
		return new CategoryList();
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function createNewEntry() {
		return new Category();
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getIndexRoute() {
		return 'admin_categories';
	}
}