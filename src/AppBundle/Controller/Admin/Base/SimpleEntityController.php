<?php

namespace AppBundle\Controller\Admin\Base;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\HttpFoundation\Request;

abstract class SimpleEntityController extends AdminEntityController
{
	protected function createFromTemplate(Request $request, $template) {
		$entry = parent::createFromTemplate($request, $template);
	
		$entry->setName($template->getName());
	
		return $entry;
	}
	
	protected function createNewFilter() {
		return new SimpleEntityFilter();
	}
	
	protected function getFilterFormType() {
		return SimpleEntityFilterType::class;
	}
	
	protected function getDeleteRole() {
		return 'ROLE_ADMIN';
	}
}