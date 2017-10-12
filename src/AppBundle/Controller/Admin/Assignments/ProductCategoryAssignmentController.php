<?php

namespace AppBundle\Controller\Admin\Assignments;

use AppBundle\Controller\Admin\Base\AssignmentController;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Product;
use AppBundle\Filter\Common\Assignments\ProductCategoryAssignmentFilter;
use AppBundle\Form\Editor\Admin\Assignments\ProductCategoryAssignmentEditorType;
use AppBundle\Form\Filter\Admin\Assignments\ProductCategoryAssignmentFilterType;
use AppBundle\Manager\Entity\Common\Assignments\ProductCategoryAssignmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Utils\StringUtils;
use Symfony\Component\HttpFoundation\Request;

class ProductCategoryAssignmentController extends AssignmentController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request        	
	 * @param integer $page        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request) {
		return $this->newActionInternal($request);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id) {
		return $this->copyActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id) {
		return $this->editActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id) {
		return $this->deleteActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setFeaturedAction(Request $request, $id) {
		return $this->setFeaturedActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	protected function setFeaturedActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSetFeaturedRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$featured = $request->get('value', false);
		$entry->setFeatured($featured);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($entry);
		
		if ($featured) {
			$product = $entry->getProduct();
			
			$brandName = StringUtils::getCleanName($product->getBrand()->getName());
			$productName = StringUtils::getCleanName($product->getName());
			
			$path = '/uploads/products/top-produkt/' . substr($brandName, 0, 1) . '/' . $brandName . '/';
			
			$product->setTopProduktImage($path . $productName . '.png');
			
			$em->persist($product);
		}
		
		$em->flush();
		
		return $this->redirectToReferer($request);
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.assignment.product_category');
	}

	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.assignment.product_category');
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(ProductCategoryAssignmentManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new ProductCategoryAssignmentFilter());
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function deleteMore($entry) {
		/** @var ProductCategoryAssignment $entry */
		$em = $this->getDoctrine()->getManager();
		$em->remove($entry->getProductNote());
		$em->flush();
	
		return array();
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	
	// TODO should be moved to FeaturedController ???
	// TODO copied from SimpleController :/
	protected function getSetFeaturedRoute() {
		return $this->getIndexRoute() . 'set_featured';
	}
	
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return ProductCategoryAssignment::class;
	}

	protected function getEditorFormType() {
		return ProductCategoryAssignmentEditorType::class;
	}

	protected function getFilterFormType() {
		return ProductCategoryAssignmentFilterType::class;
	}
}