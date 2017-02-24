<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserNewsletterPageAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterUsers = array();
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterPages = array();
	
	/**
	 *
	 * @var array
	 */
	protected $states = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->newsletterUsers = $this->getRequestArray($request, 'newsletter_blocks');
		$this->newsletterPages = $this->getRequestArray($request, 'newsletter_groups');
		
		$this->states = $this->getRequestArray($request, 'states');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->newsletterUsers = array();
		$this->newsletterPages = array();
		
		$this->states = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'newsletter_blocks', $this->newsletterUsers);
		$this->setRequestArray($values, 'newsletter_groups', $this->newsletterPages);
		
		$this->setRequestArray($values, 'states', $this->states);
		
		return $values;
	}
	
	/**
	 * Set newsletterUsers
	 *
	 * @param array $newsletterUsers
	 *
	 * @return NewsletterUserNewsletterPageAssignmentFilter
	 */
	public function setNewsletterUsers($newsletterUsers)
	{
		$this->newsletterUsers = $newsletterUsers;
	
		return $this;
	}
	
	/**
	 * Get newsletterUsers
	 *
	 * @return array
	 */
	public function getNewsletterUsers()
	{
		return $this->newsletterUsers;
	}
	
	/**
	 * Set newsletterPages
	 *
	 * @param array $newsletterPages
	 *
	 * @return NewsletterUserNewsletterPageAssignmentFilter
	 */
	public function setNewsletterPages($newsletterPages)
	{
		$this->newsletterPages = $newsletterPages;
	
		return $this;
	}
	
	/**
	 * Get newsletterUser newsletterPages
	 *
	 * @return array
	 */
	public function getNewsletterPages()
	{
		return $this->newsletterPages;
	}
	
	/**
	 * Set states
	 *
	 * @param array $states
	 *
	 * @return NewsletterUserNewsletterPageAssignmentFilter
	 */
	public function setStates($states)
	{
		$this->states = $states;
	
		return $this;
	}
	
	/**
	 * Get newsletterUser states
	 *
	 * @return array
	 */
	public function getStates()
	{
		return $this->states;
	}
}