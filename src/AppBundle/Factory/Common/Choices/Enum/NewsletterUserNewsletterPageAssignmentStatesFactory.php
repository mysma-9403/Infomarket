<?php

namespace AppBundle\Factory\Common\Choices\Enum;

use AppBundle\Entity\Assignments\NewsletterUserNewsletterPageAssignment;
use AppBundle\Factory\Common\Choices\Base\TwigChoicesFactory;

class NewsletterUserNewsletterPageAssignmentStatesFactory extends TwigChoicesFactory {

	public function __construct() {
		$this->items['label.newsletterUserNewsletterPageAssignment.state.waiting'] = NewsletterUserNewsletterPageAssignment::WAITING_STATE;
		$this->items['label.newsletterUserNewsletterPageAssignment.state.sending'] = NewsletterUserNewsletterPageAssignment::SENDING_STATE;
		$this->items['label.newsletterUserNewsletterPageAssignment.state.sent'] = NewsletterUserNewsletterPageAssignment::SENT_STATE;
		$this->items['label.newsletterUserNewsletterPageAssignment.state.error'] = NewsletterUserNewsletterPageAssignment::ERROR_STATE;
	}

	protected function getTwigFunctionName() {
		return 'newsletterUserNewsletterPageAssignmentStateName';
	}
}