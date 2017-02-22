<?php

namespace AppBundle\Filter\Admin\Other;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;


class SendNewsletterFilter extends Filter {
	
	/**
	 *
	 * @var array
	 */
	protected $groups = array();
	
	/**
	 * @var bool
	 */
	protected $embedImages = false;
	
	/**
	 * @var bool
	 */
	protected $forceSend = false;
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->groups = $this->getRequestArray($request, 'groups');
		
		$this->embedImages = $this->getRequestSimpleBool($request, 'embed_images');
		$this->forceSend = $this->getRequestSimpleBool($request, 'force_send');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->groups = array();
		
		$this->embedImages = false;
		$this->forceSend = false;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'groups', $this->groups);
		
		$this->setRequestValue($values, 'embed_images', $this->embedImages);
		$this->setRequestValue($values, 'force_send', $this->forceSend);
		
		return $values;
	}
	
	/**
	 * Set article groups
	 *
	 * @param array $articleGroups
	 *
	 * @return SendNewsletterFilter
	 */
	public function setGroups($groups)
	{
		$this->groups = $groups;
	
		return $this;
	}
	
	/**
	 * Get article groups
	 *
	 * @return array
	 */
	public function getGroups()
	{
		return $this->groups;
	}
	
	/**
	 * Set embedImages
	 *
	 * @param bool $embedImages
	 *
	 * @return Advert
	 */
	public function setEmbedImages($embedImages)
	{
		$this->embedImages = $embedImages;
	
		return $this;
	}
	
	/**
	 * Get embedImages
	 *
	 * @return bool
	 */
	public function getEmbedImages()
	{
		return $this->embedImages;
	}
	
	/**
	 * Set forceSend
	 *
	 * @param bool $forceSend
	 *
	 * @return Advert
	 */
	public function setForceSend($forceSend)
	{
		$this->forceSend = $forceSend;
	
		return $this;
	}
	
	/**
	 * Get forceSend
	 *
	 * @return bool
	 */
	public function getForceSend()
	{
		return $this->forceSend;
	}
}