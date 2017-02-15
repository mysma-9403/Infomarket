<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockMagazineAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterBlocks = array();
	
	/**
	 *
	 * @var array
	 */
	protected $magazines = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->newsletterBlocks = $this->getRequestArray($request, 'newsletter_blocks');
		$this->magazines = $this->getRequestArray($request, 'magazines');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->newsletterBlocks = array();
		$this->magazines = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'newsletter_blocks', $this->newsletterBlocks);
		$this->setRequestArray($values, 'magazines', $this->magazines);
		
		return $values;
	}
	
	/**
	 * Set newsletterBlocks
	 *
	 * @param array $newsletterBlocks
	 *
	 * @return NewsletterBlockMagazineAssignmentFilter
	 */
	public function setNewsletterBlocks($newsletterBlocks)
	{
		$this->newsletterBlocks = $newsletterBlocks;
	
		return $this;
	}
	
	/**
	 * Get newsletterBlocks
	 *
	 * @return array
	 */
	public function getNewsletterBlocks()
	{
		return $this->newsletterBlocks;
	}
	
	/**
	 * Set magazines
	 *
	 * @param array $magazines
	 *
	 * @return NewsletterBlockMagazineAssignmentFilter
	 */
	public function setMagazines($magazines)
	{
		$this->magazines = $magazines;
	
		return $this;
	}
	
	/**
	 * Get newsletterBlock magazines
	 *
	 * @return array
	 */
	public function getMagazines()
	{
		return $this->magazines;
	}
}