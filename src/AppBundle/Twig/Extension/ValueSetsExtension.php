<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Entity\BenchmarkField;

class ValueSetsExtension extends \Twig_Extension
{
	public function getFunctions()
    {
		$extensions = array();
        
		$extensions['newsletterUserNewsletterPageAssignmentStateName'] = new \Twig_SimpleFunction(
				'newsletterUserNewsletterPageAssignmentStateName',
				NewsletterUserNewsletterPageAssignment::class . '::getStateName');
		
		$extensions['benchmarkFieldValueTypeDBName'] = new \Twig_SimpleFunction(
				'benchmarkFieldValueTypeDBName',
				BenchmarkField::class . '::getValueTypeDBName');
		
		$extensions['benchmarkFieldValueTypeName'] = new \Twig_SimpleFunction(
				'benchmarkFieldValueTypeName',
				BenchmarkField::class . '::getValueTypeName');
		
		$extensions['benchmarkFieldFieldTypeName'] = new \Twig_SimpleFunction(
				'benchmarkFieldFieldTypeName',
				BenchmarkField::class . '::getFieldTypeName');
		
		$extensions['benchmarkFieldFilterTypeName'] = new \Twig_SimpleFunction(
				'benchmarkFieldFilterTypeName',
				BenchmarkField::class . '::getFilterTypeName');
		
		return $extensions;
    }
}