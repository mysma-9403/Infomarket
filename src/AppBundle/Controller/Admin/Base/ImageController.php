<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Controller\Admin\Base\SimpleController;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadedFileInfo;
use Symfony\Component\HttpFoundation\Request;

abstract class ImageController extends SimpleController {
	
	// TODO make ActionInternal
	public function removeImageAction(Request $request, $id) {
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getRemoveImageRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		if ($entry) {
			if (file_exists($entry->getImage())) {
				unlink($entry->getImage());
			}
			
			$em = $this->getDoctrine()->getManager();
			
			$entry->removeImage();
			
			$em->persist($entry);
			$em->flush();
		}
		
		/** @var RouteManager $rm */
		$rm = $this->getRouteManager();
		$lastRoute = $rm->getLastRoute($request, $this->getIndexRoute());
		return $this->redirectToRoute($lastRoute['route'], $lastRoute['routeParams']);
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Controller\Admin\Base\SimpleController::prepareEntry()
	 */
	protected function prepareEntry($request, &$entry, $params) {
		parent::prepareEntry($request, $entry, $params);
		if ($entry->getFile()) {
			$uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
			$uploadableManager->markEntityToUpload($entry, new UploadedFileInfo($entry->getFile()));
		}
	}
	
	// TODO move to ImageManager
	protected function createFromTemplate(Request $request, $template) {
		$entry = parent::createFromTemplate($request, $template);
		
		$entry->setVertical($template->getVertical());
		
		$entry->setForcedWidth($template->getForcedWidth());
		$entry->setForcedHeight($template->getForcedHeight());
		
		return $entry;
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getRemoveImageRoute() {
		return $this->getIndexRoute() . '_remove_image';
	}
}