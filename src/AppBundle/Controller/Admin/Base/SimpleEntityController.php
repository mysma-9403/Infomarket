<?php

namespace AppBundle\Controller\Admin\Base;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Form\Lists\Base\SimpleEntityListType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
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
	
	protected function getListFormType() {
		return SimpleEntityListType::class;
	}
	
	protected function getFilterFormType() {
		return SimpleEntityFilterType::class;
	}
}