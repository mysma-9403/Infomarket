<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;

class ValueSetsExtension extends \Twig_Extension
{
	public function getFunctions()
    {
		$extensions = array();
        
		$extensions['newsletterUserNewsletterPageAssignmentStateName'] = new \Twig_Function_Method($this, 'getNewsletterUserNewsletterPageAssignmentStateName');
		
		return $extensions;
    }
    
    public function getNewsletterUserNewsletterPageAssignmentStateName($state) {
    	return NewsletterUserNewsletterPageAssignment::getStateName($state);
    }
}