<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Entity\Lists\Base\BaseEntityList;
use AppBundle\Entity\User;
use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Lists\Base\BaseEntityListType;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Main\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Base\BaseType;



abstract class BaseEntityController extends AdminController
{	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
		
		/** @var UserRepository $userRepository */
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$users = $userRepository->findFilterItems();
		$options[BaseType::getChoicesName('createdBy')] = $users;
		$options[BaseType::getChoicesName('updatedBy')] = $users; //TODO there should be probably two different lists
		
		return $options;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {	
		return new FilterManager(new AuditFilter());
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function createNewList() {
		return new BaseEntityList();
	}
	
	/**
	 *
	 * @return FilterFormType
	 */
	protected function getFilterFormType() {
		return AdminFilterType::class;
	}
	
	/**
	 *
	 * @return BaseEntityListType
	 */
	protected function getListFormType() {
		return BaseEntityListType::class;
	}
}