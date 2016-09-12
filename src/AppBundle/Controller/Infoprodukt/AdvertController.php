<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Base\BaseEntityController;
use AppBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;

class AdvertController extends SimpleEntityController
{   
	/**
	 * 
	 * @param Request $request
	 */
	public function clickAction(Request $request, $id)
	{
		return $this->clickActionInternal($request, $id);
	}

	protected function clickActionInternal(Request $request, $id)
	{
		$this->sendAdvertEventAnalytics($request, $id);
		
		$entry = $this->getEntry($id);
		$entry->setClickCount($entry->getClickCount()+1);
		
		$this->saveEntry($entry);
		
		return $this->redirect($request->getScheme() . '://' . $entry->getLink());
	}
	
	protected function sendAdvertEventAnalytics(Request $request, $id)
	{
		$tracker = $this->get('happyr.google_analytics.tracker');
	
		$data = array(
				'v' => $this->version,
				't' => 'event',
				'ec' => 'advert',
				'ea' => 'click',
				'el' => 'id',
				'ev' => $id
		);
	
		$tracker->send($data, 'pageview');
	}
	
	protected function saveEntry($entry) {
		$em = $this->getDoctrine()->getManager();
			
		$em->persist($entry);
		$em->flush();
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityType()
	 */
    protected function getEntityType()
    {
    	return Advert::class;
    }
}
