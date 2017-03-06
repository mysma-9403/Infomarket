<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Entity\BenchmarkField;

class ValueSetsExtension extends \Twig_Extension
{
	public function getFunctions()
    {
		$extensions = array();
        
		$extensions['newsletterUserNewsletterPageAssignmentStateName'] = new \Twig_Function_Function(
				NewsletterUserNewsletterPageAssignment::class . '::getStateName');
		
		$extensions['benchmarkFieldValueTypeDBName'] = new \Twig_Function_Function(
				BenchmarkField::class . '::getValueTypeDBName');
		
		$extensions['benchmarkFieldValueTypeName'] = new \Twig_Function_Function(
				BenchmarkField::class . '::getValueTypeName');
		
		$extensions['benchmarkFieldFieldTypeName'] = new \Twig_Function_Function(
				BenchmarkField::class . '::getFieldTypeName');
		
		$extensions['benchmarkFieldFilterTypeName'] = new \Twig_Function_Function(
				BenchmarkField::class . '::getFilterTypeName');
		
		return $extensions;
    }
}