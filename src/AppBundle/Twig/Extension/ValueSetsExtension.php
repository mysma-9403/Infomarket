<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;

class ValueSetsExtension extends \Twig_Extension
{
	public function getFunctions()
    {
		$extensions = array();
        
		$extensions['advertLocationName'] = new \Twig_SimpleFunction('advertLocationName', Advert::class . '::getLocationName');
		
		$extensions['articleLayoutName'] = new \Twig_SimpleFunction('articleLayoutName', Article::class . '::getLayoutName');
		$extensions['articleImageSizeName'] = new \Twig_SimpleFunction('articleImageSizeName', Article::class . '::getImageSizeName');
		
		$extensions['newsletterUserNewsletterPageAssignmentStateName'] = new \Twig_SimpleFunction(
				'newsletterUserNewsletterPageAssignmentStateName', NewsletterUserNewsletterPageAssignment::class . '::getStateName');
		
		$extensions['benchmarkFieldValueTypeDBName'] = new \Twig_SimpleFunction(
				'benchmarkFieldValueTypeDBName', BenchmarkField::class . '::getValueTypeDBName');
		
		$extensions['benchmarkFieldValueTypeName'] = new \Twig_SimpleFunction(
				'benchmarkFieldValueTypeName', BenchmarkField::class . '::getValueTypeName');
		
		$extensions['benchmarkFieldFieldTypeName'] = new \Twig_SimpleFunction(
				'benchmarkFieldFieldTypeName', BenchmarkField::class . '::getFieldTypeName');
		
		$extensions['benchmarkFieldFilterTypeName'] = new \Twig_SimpleFunction(
				'benchmarkFieldFilterTypeName', BenchmarkField::class . '::getFilterTypeName');
		
		$extensions['benchmarkFieldNoteTypeName'] = new \Twig_SimpleFunction(
				'benchmarkFieldNoteTypeName', BenchmarkField::class . '::getNoteTypeName');
		
		$extensions['benchmarkFieldBetterThanTypeName'] = new \Twig_SimpleFunction(
				'benchmarkFieldBetterThanTypeName', BenchmarkField::class . '::getBetterThanTypeName');
		
		return $extensions;
    }
}