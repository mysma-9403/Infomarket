<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadedFileInfo;
use Symfony\Component\HttpFoundation\Request;

abstract class ImageEntityController extends SimpleEntityController {
	
	public function removeImageAction(Request $request, $id) {
		
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
		
		$entry = $this->getEntry($id);
		if($entry) {
			if(file_exists($entry->getImagePath())) {
				unlink($entry->getImage());
			}
			 
			$em = $this->getDoctrine()->getManager();
			
			$entry->removeImage();
			
			$em->persist($entry);
			$em->flush();
		}
    	
    	$routingParams = $this->getRoutingParams($request);
    	return $this->redirectToRoute($routingParams['route'], $routingParams['routeParams']);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::prepareEntry()
	 */
	protected function prepareEntry($entry) {
		if($entry->getFile()) {
			$uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
			$uploadableManager->markEntityToUpload($entry, new UploadedFileInfo($entry->getFile()));
		}
	}
}