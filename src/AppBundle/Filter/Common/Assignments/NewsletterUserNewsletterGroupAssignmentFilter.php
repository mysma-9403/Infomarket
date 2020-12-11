<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserNewsletterGroupAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $newsletterUsers = array();

	/**
	 *
	 * @var array
	 */
	protected $newsletterGroups = array();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->newsletterUsers = $this->getRequestArray($request, 'newsletter_blocks');
		$this->newsletterGroups = $this->getRequestArray($request, 'newsletter_groups');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->newsletterUsers = array();
		$this->newsletterGroups = array();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'newsletter_blocks', $this->newsletterUsers);
		$this->setRequestArray($values, 'newsletter_groups', $this->newsletterGroups);
		
		return $values;
	}

	public function setNewsletterUsers($newsletterUsers) {
		$this->newsletterUsers = $newsletterUsers;
		
		return $this;
	}

	public function getNewsletterUsers() {
		return $this->newsletterUsers;
	}

	public function setNewsletterGroups($newsletterGroups) {
		$this->newsletterGroups = $newsletterGroups;
		
		return $this;
	}

	public function getNewsletterGroups() {
		return $this->newsletterGroups;
	}
}