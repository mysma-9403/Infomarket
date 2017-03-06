<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Utils\ClassUtils;

class CleanNameExtension extends \Twig_Extension
{
	public function getFilters()
    {
		$extensions = array();
		
		$extensions['clean'] = new \Twig_Filter_Function(ClassUtils::class . '::getCleanName');
		
		return $extensions;
    }
}