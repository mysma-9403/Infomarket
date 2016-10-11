<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Manager\Filter\Base\SimpleEntityFilterManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



abstract class SimpleEntityController extends AdminEntityController
{
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getFilterManager($doctrine) {	
		return new SimpleEntityFilterManager($doctrine);
	}
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return SimpleEntityFilterType::class;
	}
	
	//---------------------------------------------------------------------------
	// Settings
	//---------------------------------------------------------------------------
	
	protected function getDeleteRole() {
		return 'ROLE_ADMIN';
	}
}