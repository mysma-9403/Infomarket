<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Base\BaseFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

abstract class FeaturedController extends ImageController {
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request        	
	 * @param BaseFormType $form        	
	 */
	protected function listFormActionInternal(Request $request, Form $form, BaseFilter $filter, array $listItems, array $params) {
		if ($form->get('setFeaturedSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'featured', 1);
		}
		
		if ($form->get('setNotFeaturedSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'featured', 0);
		}
		
		return parent::listFormActionInternal($request, $form, $filter, $listItems, $params);
	}

	protected function setFeaturedActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSetFeaturedRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$featured = $request->get('value', false);
		
		$em = $this->getDoctrine()->getManager();
		
		$entry->setFeatured($featured);
		$em->persist($entry);
		$em->flush();
		
		return $this->redirectToReferer($request);
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getSetFeaturedRoute() {
		return $this->getIndexRoute() . 'set_featured';
	}
}