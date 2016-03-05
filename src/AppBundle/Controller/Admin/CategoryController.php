<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\ImageTreeController;
use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends ImageTreeController {
	
	public function setFeaturedAction(Request $request, $id)
	{
		$featured = $request->get('featured', false);
		
		$em = $this->getDoctrine()->getManager();
	
		//Make sure entity exists :)
		$entry = $this->getEntry($id);
		$entry->setFeatured($featured);
		$em->persist($entry);
		$em->flush();
	
		return $this->redirectToRoute($this->getIndexRoute());
	}
	
	//------------------------------------------------------------------------
	// Entity creators
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createNewEntity()
	 */
	protected function createNewEntity(Request $request) {
		return new Category();
	}
	
	
	//------------------------------------------------------------------------
	// Entity types
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return Category::class;
	}
	
	
	//------------------------------------------------------------------------
	// Form types
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getFormType() {
		return CategoryType::class;
	}
}