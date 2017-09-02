<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockAdvertAssignmentFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var array
	 */
	protected $newsletterBlocks = array ();

	/**
	 *
	 * @var array
	 */
	protected $adverts = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->newsletterBlocks = $this->getRequestArray($request, 'newsletter_blocks');
		$this->adverts = $this->getRequestArray($request, 'adverts');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->newsletterBlocks = array ();
		$this->adverts = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'newsletter_blocks', $this->newsletterBlocks);
		$this->setRequestArray($values, 'adverts', $this->adverts);
		
		return $values;
	}

	public function setNewsletterBlocks($newsletterBlocks) {
		$this->newsletterBlocks = $newsletterBlocks;
		
		return $this;
	}

	public function getNewsletterBlocks() {
		return $this->newsletterBlocks;
	}

	public function setAdverts($adverts) {
		$this->adverts = $adverts;
		
		return $this;
	}

	public function getAdverts() {
		return $this->adverts;
	}
}