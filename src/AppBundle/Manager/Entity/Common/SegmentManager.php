<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Segment;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class SegmentManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Segment
	 */
	public function createFromRequest(Request $request) {
		/** @var Segment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setColor($request->get('color'));
		
		$entry->setContent($request->get('content'));
		
		$entry->setOrderNumber($request->get('order_number'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Segment $template
	 * 
	 * @return Segment
	 */
	public function createFromTemplate($template) {
		/** @var Segment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setColor($template->getColor());
		
		$entry->setContent($template->getContent());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Segment::class;
	}
}