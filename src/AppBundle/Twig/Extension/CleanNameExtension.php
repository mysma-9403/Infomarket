<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Utils\StringUtils;

class CleanNameExtension extends \Twig_Extension
{
	public function getFilters()
    {
		$extensions = array();
		
		$extensions['clean'] = new \Twig_SimpleFilter('clean', StringUtils::class . '::getCleanName');
		
		return $extensions;
    }
}