<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserNewsletterGroupAssignmentFilter extends AuditFilter {
	
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
	
	/**
	 * Set newsletterUsers
	 *
	 * @param array $newsletterUsers
	 *
	 * @return NewsletterUserNewsletterGroupAssignmentFilter
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
	 * Set newsletterGroups
	 *
	 * @param array $newsletterGroups
	 *
	 * @return NewsletterUserNewsletterGroupAssignmentFilter
	 */
	public function setNewsletterGroups($newsletterGroups)
	{
		$this->newsletterGroups = $newsletterGroups;
	
		return $this;
	}
	
	/**
	 * Get newsletterUser newsletterGroups
	 *
	 * @return array
	 */
	public function getNewsletterGroups()
	{
		return $this->newsletterGroups;
	}
}