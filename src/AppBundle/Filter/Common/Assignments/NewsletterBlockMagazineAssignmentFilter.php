<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockMagazineAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $newsletterBlocks = array ();

	/**
	 *
	 * @var array
	 */
	protected $magazines = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->newsletterBlocks = $this->getRequestArray($request, 'newsletter_blocks');
		$this->magazines = $this->getRequestArray($request, 'magazines');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->newsletterBlocks = array ();
		$this->magazines = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'newsletter_blocks', $this->newsletterBlocks);
		$this->setRequestArray($values, 'magazines', $this->magazines);
		
		return $values;
	}

	public function setNewsletterBlocks($newsletterBlocks) {
		$this->newsletterBlocks = $newsletterBlocks;
		
		return $this;
	}

	public function getNewsletterBlocks() {
		return $this->newsletterBlocks;
	}

	public function setMagazines($magazines) {
		$this->magazines = $magazines;
		
		return $this;
	}

	public function getMagazines() {
		return $this->magazines;
	}
}