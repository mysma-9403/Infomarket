<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\ImageEntityController;
use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Filter\Admin\Main\ProductFilter;
use AppBundle\Form\Editor\Main\ProductEditorType;
use AppBundle\Form\Filter\Admin\Main\ProductFilterType;
use AppBundle\Manager\Entity\Common\ProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Main\BrandRepository;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use AppBundle\Utils\StringUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use AppBundle\Form\Filter\Admin\Other\CategoryFilterType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Params\EntryParams\Admin\ProductEntryParamsManager;
use AppBundle\Entity\ProductNote;

class ProductController extends ImageEntityController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request)
	{
		return $this->newActionInternal($request);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id)
	{
		return $this->copyActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id)
	{
		return $this->editActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIMPublishedAction(Request $request, $id)
	{
		return $this->setIMPublishedActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIPPublishedAction(Request $request, $id)
	{
		return $this->setIPPublishedActionInternal($request, $id);
	}
	
	public function deleteUnusedAction(Request $request) {
		return $this->deleteUnusedActionInternal($request);
	}
	
	public function getTopProductsAction(Request $request) {
		return $this->getTopProductsActionInternal($request);
	}

	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	protected function getTopProductsActionInternal(Request $request) {
		$response = new StreamedResponse();
		$response->setCallback(function() {
			$handle = fopen('php://output', 'w+');
			
			$connection = $this->get('database_connection');
			
			$results = $connection->fetchAll("SELECT p.name AS productName, b.name AS brandName FROM products p JOIN brands b ON b.id = p.brand_id JOIN product_category_assignments pca ON pca.product_id = p.id WHERE pca.featured = true");
			
			if(count($results) > 0) {
				foreach ($results as $row) {
					$productName = $row['productName'];
					$brandName = StringUtils::getCleanName($row['brandName']);
					$path = '/uploads/products/top-produkt/' . substr($brandName, 0, 1) . '/' . $brandName;
					
					$fields = array($productName, $path);
					fputs($handle, implode($fields, ';')."\n");
				}
			} else {
				fputcsv($handle, array(''), ';');
			}
		
			fclose($handle);
		});
		
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'text/csv; charset=utf-8');
		$response->headers->set('Content-Disposition', 'attachment; filename="top-produkt.csv"');
	
		return $response;
	}
	
	protected function deleteUnusedActionInternal(Request $request) 
	{
		$this->denyAccessUnlessGranted('ROLE_RATING_EDITOR', null, 'Unable to access this page!');
		
		$result = $this->deleteUnused();
		$errors = $result['errors'];
		if (count($errors) > 0) {
			foreach ($errors as $error) {
				$this->addFlash('error', $error);
			}
		} else {
			$translator = $this->get('translator');
			
			$count = $result['count'];
				
			$msg = $translator->trans('success.product.unusedRemoved');
			$msg = nl2br($msg);
				
			$msg = str_replace('%count%', $count, $msg);
			$this->addFlash('success', $msg);
		}
		
		return $this->redirectToReferer($request);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function initShowForms(Request $request, array &$params) {
		$response = parent::initShowForms($request, $params);
		if($response) return $response;
	
		$response = $this->initCategoryForm($request, $params);
		if($response) return $response;
	
		return null;
	}
	
	protected function initEditForms(Request $request, array &$params) {
		$response = $this->initEditorForm($request, $params);
		if($response) return $response;
		
		$response = $this->initCategoryForm($request, $params);
		if($response) return $response;
		
		return null;
	}
	
	protected function initEditorForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
	
		$productFilter = $viewParams['productFilter'];
		
		$form = $this->createForm($this->getEditorFormType(), $entry, ['filter' => $productFilter]);
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			$this->saveEntry($request, $entry, $params);
	
			$translator = $this->get('translator');
			$message = $translator->trans('success.created');
			$message = str_replace('%type%', '<b>' . StringUtils::getClassName($this->getEntityType()) . '</b>', $message);
			$this->addFlash('success', $message);
	
			if ($form->get('save')->isClicked()) {
				return $this->redirectToRoute($this->getEditRoute(), array('id' => $entry->getId()));
			}
		}
	
		$viewParams['form'] = $form->createView();
		$params['viewParams'] = $viewParams;
	
		return null;
	}
	
	protected function initCategoryForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$categoryFilter = $viewParams['categoryFilter'];
		$entry = $viewParams['entry'];
	
		$form = $this->createForm(CategoryFilterType::class, $categoryFilter, ['product' => $entry->getId()]);
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			if ($form->get('submit')->isClicked()) {
				$params = $categoryFilter->getRequestValues();
				$params['id'] = $entry->getId();
		
				$lastRoute = $this->getRouteManager()->getLastRoute($request);
				$route = $lastRoute['route'];
				$size = strlen($route);
				$ending = substr($route, $size - 5, 5);
				
				if($ending == '_show') {
					return $this->redirectToRoute($this->getShowRoute(), $params);
				} else {
					return $this->redirectToRoute($this->getEditRoute(), $params);
				}
			}
		}
	
		$viewParams['categoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
	
		return null;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		/** @var BrandRepository $brandRepository */
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$options['brands'] = $brandRepository->findFilterItems();
	
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$options['categories'] = $categoryRepository->findFilterItems();
	
		return $options;
	}
	
	protected function saveMore($request, $entry, $params) {
		parent::saveMore($request, $entry, $params);
	
		//TODO copy-pasted in CustomProductController - should be unified
		if(!$entry->getProductNote()) {
			$note = new ProductNote();
			$note->setProduct($entry);
			$note->setOveralNote(2.0); //TODO first note should be calculated here!
				
			/** @var \Doctrine\Common\Persistence\ObjectManager $em */
			$em = $this->getDoctrine()->getManager();
				
			$em->persist($note);
			$em->flush();
		}
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::deleteMore()
	 */
	protected function deleteMore($entry)
	{
		/** @var Product $entry */
		$em = $this->getDoctrine()->getManager();
		foreach ($entry->getProductCategoryAssignments() as $productCategoryAssignment) {
			$em->remove($productCategoryAssignment);
		}
		$em->flush();
		
		if($entry->getProductNote()) {
			$em->remove($entry->getProductNote());
		}
		$em->flush();
	
		return array();
	}
	
	protected function deleteUnused()
	{
		$result = array();
		$errors = array();
		
		$repository = $this->getDoctrine()->getRepository($this->getEntityType());
		$all = $repository->findAll();
		
		$entries = array();
		/** @var Product $entry */
		foreach($all as $entry) {
			if(count($entry->getProductCategoryAssignments()) <= 0) {
				$entries[] = $entry;
			}
		}
	
		$count = 0;
		
		$em = $this->getDoctrine()->getManager();
		$em->getConnection()->beginTransaction();
	
		try {
			foreach ($entries as $entry) {
				$em->remove($entry);
				$count++;
			}
			$em->flush();
				
			$em->getConnection()->commit();
		} catch (Exception $ex) {
			$em->getConnection()->rollback();
			$errors[] = $ex->getMessage();
		}
		
		$result['count'] = $count;
		$result['errors'] = $errors;
		return $result;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new ProductEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new ProductManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new ProductFilter());
	}
	
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return Product::class;
	}
	
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return ProductEditorType::class;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return ProductFilterType::class;
	}
}
