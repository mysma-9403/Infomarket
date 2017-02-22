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
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->newsletterUsers = $this->getRequestArray($request, 'newsletter_blocks');
		$this->newsletterPages = $this->getRequestArray($request, 'newsletter_groups');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->newsletterUsers = array();
		$this->newsletterPages = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'newsletter_blocks', $this->newsletterUsers);
		$this->setRequestArray($values, 'newsletter_groups', $this->newsletterPages);
		
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
}