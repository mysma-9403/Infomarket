<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Factory\Common\Choices\Base\ChoicesFactory;

class NewsletterUserNewsletterPageAssignmentStatesFactory implements ChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				NewsletterUserNewsletterPageAssignment::getStateName(NewsletterUserNewsletterPageAssignment::WAITING_STATE) => NewsletterUserNewsletterPageAssignment::WAITING_STATE,
				NewsletterUserNewsletterPageAssignment::getStateName(NewsletterUserNewsletterPageAssignment::SENDING_STATE) => NewsletterUserNewsletterPageAssignment::SENDING_STATE,
				NewsletterUserNewsletterPageAssignment::getStateName(NewsletterUserNewsletterPageAssignment::SENT_STATE) => NewsletterUserNewsletterPageAssignment::SENT_STATE,
				NewsletterUserNewsletterPageAssignment::getStateName(NewsletterUserNewsletterPageAssignment::ERROR_STATE) => NewsletterUserNewsletterPageAssignment::ERROR_STATE
		];
	}
	
}