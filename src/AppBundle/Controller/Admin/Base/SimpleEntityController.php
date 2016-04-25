<?php

namespace AppBundle\Controller\Admin\Base;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Form\Lists\Base\SimpleEntityListType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;

abstract class SimpleEntityController extends AdminEntityController
{
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