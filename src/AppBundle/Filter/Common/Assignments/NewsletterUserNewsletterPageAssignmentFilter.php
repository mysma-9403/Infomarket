<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserNewsletterPageAssignmentFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var array
	 */
	protected $newsletterUsers = array ();

	/**
	 *
	 * @var array
	 */
	protected $newsletterPages = array ();

	/**
	 *
	 * @var array
	 */
	protected $states = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->newsletterUsers = $this->getRequestArray($request, 'newsletter_blocks');
		$this->newsletterPages = $this->getRequestArray($request, 'newsletter_groups');
		
		$this->states = $this->getRequestArray($request, 'states');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->newsletterUsers = array ();
		$this->newsletterPages = array ();
		
		$this->states = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'newsletter_blocks', $this->newsletterUsers);
		$this->setRequestArray($values, 'newsletter_groups', $this->newsletterPages);
		
		$this->setRequestArray($values, 'states', $this->states);
		
		return $values;
	}

	public function setNewsletterUsers($newsletterUsers) {
		$this->newsletterUsers = $newsletterUsers;
		
		return $this;
	}

	public function getNewsletterUsers() {
		return $this->newsletterUsers;
	}

	public function setNewsletterPages($newsletterPages) {
		$this->newsletterPages = $newsletterPages;
		
		return $this;
	}

	public function getNewsletterPages() {
		return $this->newsletterPages;
	}

	public function setStates($states) {
		$this->states = $states;
		
		return $this;
	}

	public function getStates() {
		return $this->states;
	}
}