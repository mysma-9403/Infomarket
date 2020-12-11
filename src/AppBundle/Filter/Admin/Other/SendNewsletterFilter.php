<?php

namespace AppBundle\Filter\Admin\Other;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class SendNewsletterFilter extends Filter {

	/**
	 *
	 * @var array
	 */
	protected $newsletterGroups = array();

	/**
	 *
	 * @var integer
	 */
	protected $newsletterPage = null;

	/**
	 *
	 * @var bool
	 */
	protected $embedImages = false;

	/**
	 *
	 * @var bool
	 */
	protected $forceSend = false;

	public function initContextParams(array $contextParams) {
		if (key_exists('newsletterPage', $contextParams)) {
			$this->newsletterPage = $contextParams['newsletterPage'];
		}
	}

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->newsletterGroups = $this->getRequestArray($request, 'newsletterGroups');
		
		$this->embedImages = $this->getRequestSimpleBool($request, 'embed_images');
		$this->forceSend = $this->getRequestSimpleBool($request, 'force_send');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->newsletterGroups = array();
		
		$this->embedImages = false;
		$this->forceSend = false;
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'newsletterGroups', $this->newsletterGroups);
		
		$this->setRequestValue($values, 'embed_images', $this->embedImages);
		$this->setRequestValue($values, 'force_send', $this->forceSend);
		
		return $values;
	}

	public function setNewsletterGroups($newsletterGroups) {
		$this->newsletterGroups = $newsletterGroups;
		
		return $this;
	}

	public function getNewsletterGroups() {
		return $this->newsletterGroups;
	}

	public function setNewsletterPage($newsletterPage) {
		$this->newsletterPage = $newsletterPage;
		
		return $this;
	}

	public function getNewsletterPage() {
		return $this->newsletterPage;
	}

	public function setEmbedImages($embedImages) {
		$this->embedImages = $embedImages;
		
		return $this;
	}

	public function getEmbedImages() {
		return $this->embedImages;
	}

	public function setForceSend($forceSend) {
		$this->forceSend = $forceSend;
		
		return $this;
	}

	public function getForceSend() {
		return $this->forceSend;
	}
}