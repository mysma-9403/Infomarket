<?php

namespace AppBundle\Controller\Admin\Base;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Lists\Base\BaseEntityList;
use AppBundle\Form\Lists\Base\BaseEntityListType;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Filter\Base\BaseEntityFilterType;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;



abstract class BaseEntityController extends AdminController
{
	
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {	
		return new BaseEntityFilterManager($doctrine);
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function createNewList() {
		return new BaseEntityList();
	}
	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminController::getEditorFormType()
	 */
	protected function getEditorFormType() {
		return BaseEntityEditorType::class;
	}
	
	/**
	 *
	 * @return FilterFormType
	 */
	protected function getFilterFormType() {
		return BaseEntityFilterType::class;
	}
	
	/**
	 *
	 * @return BaseEntityListType
	 */
	protected function getListFormType() {
		return BaseEntityListType::class;
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getDeleteRole() {
		return 'ROLE_EDITOR';
	}
}