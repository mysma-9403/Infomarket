<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class IsArticleTagAssignmentUnique extends Constraint
{
    public $message = '';
    
    public function validatedBy()
    {
    	return 'is_article_tag_assignment_unique';
    }
}