<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockAdvertAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterBlocks = array();
	
	/**
	 *
	 * @var array
	 */
	protected $adverts = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->newsletterBlocks = $this->getRequestArray($request, 'newsletter_blocks');
		$this->adverts = $this->getRequestArray($request, 'adverts');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->newsletterBlocks = array();
		$this->adverts = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'newsletter_blocks', $this->newsletterBlocks);
		$this->setRequestArray($values, 'adverts', $this->adverts);
		
		return $values;
	}
	
	/**
	 * Set newsletterBlocks
	 *
	 * @param array $newsletterBlocks
	 *
	 * @return NewsletterBlockAdvertAssignmentFilter
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
	 * Set adverts
	 *
	 * @param array $adverts
	 *
	 * @return NewsletterBlockAdvertAssignmentFilter
	 */
	public function setAdverts($adverts)
	{
		$this->adverts = $adverts;
	
		return $this;
	}
	
	/**
	 * Get newsletterBlock adverts
	 *
	 * @return array
	 */
	public function getAdverts()
	{
		return $this->adverts;
	}
}