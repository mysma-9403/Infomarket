<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockTemplateFilter extends SimpleEntityFilter {
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		return $values;
	}
}