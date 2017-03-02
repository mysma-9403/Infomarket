<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Entity\BenchmarkField;

class ValueSetsExtension extends \Twig_Extension
{
	public function getFunctions()
    {
		$extensions = array();
        
		$extensions['newsletterUserNewsletterPageAssignmentStateName'] = new \Twig_Function_Method($this, 'getNewsletterUserNewsletterPageAssignmentStateName');
		
		$extensions['benchmarkFieldValueTypeDBName'] = new \Twig_Function_Method($this, 'getBenchmarkFieldValueTypeDBName');
		
		return $extensions;
    }
    
    public function getNewsletterUserNewsletterPageAssignmentStateName($value) {
    	return NewsletterUserNewsletterPageAssignment::getStateName($value);
    }
    
    public function getBenchmarkFieldValueTypeDBName($value) {
    	return BenchmarkField::getValueTypeDBName($value);
    }
}