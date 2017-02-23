<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\ImageEntityController;
use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\ImportRatings;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Entity\Segment;
use AppBundle\Filter\Admin\Main\CategoryFilter;
use AppBundle\Form\Editor\Main\CategoryEditorType;
use AppBundle\Form\Filter\Admin\Main\CategoryFilterType;
use AppBundle\Form\Other\ImportRatingsType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\CategoryEntryParamsManager;
use AppBundle\Repository\Admin\Main\BranchRepository;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use AppBundle\Utils\ClassUtils;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends ImageEntityController {
	
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
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setFeaturedAction(Request $request, $id)
	{
		return $this->setFeaturedActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setPreleafAction(Request $request, $id)
	{
		return $this->setPreleafActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function treeAction(Request $request)
	{
		return $this->treeActionInternal($request);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function ratingsAction(Request $request, $id)
	{
		return $this->ratingsActionInternal($request, $id);
	}
	
	public function clearRatingsAction(Request $request, $id)
	{
		return $this->clearRatingsActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	protected function setPreleafActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getSetPreleafRoute());
		$params = $this->getEditParams($request, $params, $id);
	
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
	
		$preleaf = $request->get('value', false);
	
		$em = $this->getDoctrine()->getManager();
	
		$entry->setPreleaf($preleaf);
		$em->persist($entry);
		$em->flush();
	
		return $this->redirectToReferer($request);
	}
	
	protected function treeActionInternal(Request $request)
	{
		$params = $this->createParams($this->getTreeRoute());
		$params = $this->getTreeParams($request, $params);
	
		$viewParams = $params['viewParams'];
		
		
		
		
// 		$filter = $viewParams['entryFilter'];
		
// 		$filterForm = $this->createForm($this->getFilterFormType(), $filter);
// 		$filterForm->handleRequest($request);
		
// 		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
		
// 			if ($filterForm->get('search')->isClicked()) {
// 				return $this->redirectToRoute($this->getTreeRoute(), $filter->getValues());
// 			}
		
// 			if ($filterForm->get('clear')->isClicked()) {
// 				$filter->clearQueryValues();
// 				return $this->redirectToRoute($this->getTreeRoute(), $filter->getValues());
// 			}
// 		}
// 		$viewParams['filter'] = $filterForm->createView();
		
		
		
		
		
		return $this->render($this->getTreeView(), $viewParams);
	}
	
	protected function ratingsActionInternal(Request $request, $id)
	{
		$params = $this->createParams($this->getRatingsRoute());
		$params = $this->getRatingsParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		$am->sendEventAnalytics($this->getEntityName(), 'ratings', $id);
		
		$importRatings = new ImportRatings();
		
		$importRatingsForm = $this->createForm(ImportRatingsType::class, $importRatings);
		$importRatingsForm->handleRequest($request);
		
		if ($importRatingsForm->isSubmitted() && $importRatingsForm->isValid()) {
			
			$result = $this->importRatings($importRatings);
			$errors = $result['errors'];
			if(count($errors) > 0) {
				foreach ($errors as $error) {
					$this->addFlash('error', $error);
				}
			} else {
				$translator = $this->get('translator');
				
				$lines = $result['lines'];
				
				$createdProducts = $result['productsCounts']['created'];
				$updatedProducts = $result['productsCounts']['updated'];
				$duplicateProducts = $result['productsCounts']['duplicates'];
				$allProducts = $result['productsCounts']['all'];
				
				$createdAssignments = $result['assignmentsCounts']['created'];
				$updatedAssignments = $result['assignmentsCounts']['updated'];
				$allAssignments = $result['assignmentsCounts']['all'];
				
				$msg = $translator->trans('success.category.ratingsImported');
				$msg = nl2br($msg);
				
				$msg = str_replace('%lines%', $lines, $msg);
				
				$msg = str_replace('%createdProducts%', $createdProducts, $msg);
				$msg = str_replace('%updatedProducts%', $updatedProducts, $msg);
				$msg = str_replace('%duplicateProducts%', $duplicateProducts, $msg);
				$msg = str_replace('%allProducts%', $allProducts, $msg);
				
				$msg = str_replace('%createdAssignments%', $createdAssignments, $msg);
				$msg = str_replace('%updatedAssignments%', $updatedAssignments, $msg);
				$msg = str_replace('%allAssignments%', $allAssignments, $msg);
				
				$this->addFlash('success', $msg);
			}
			
			return $this->redirectToReferer($request);
		}
		
		$viewParams = $params['viewParams'];
		$viewParams['importRatingsForm'] = $importRatingsForm->createView();
		
		return $this->render($this->getRatingsView(), $viewParams);
	}
	
	protected function clearRatingsActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted('ROLE_RATING_EDITOR', null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getRatingsRoute());
		$params = $this->getEditParams($request, $params, $id);
	
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
	
		$result = $this->clearRatings($entry);
		$errors = $result['errors'];
		if (count($errors) > 0) {
			foreach ($errors as $error) {
				$this->addFlash('error', $error);
			}
		} else {
			$translator = $this->get('translator');
				
			$count = $result['count'];
			
			$msg = $translator->trans('success.category.ratingsCleared');
			$msg = nl2br($msg);
			
			$msg = str_replace('%count%', $count, $msg);
			$this->addFlash('success', $msg);
		}
		
		return $this->redirectToReferer($request);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$options['parents'] = $categoryRepository->findFilterItems();
		
		/** @var BranchRepository $branchRepository */
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$options['branches'] = $branchRepository->findFilterItems();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\ImageEntityController::prepareEntry()
	 * 
	 */
	protected function prepareEntry($entry) {
		/** @var Category $entry */
		$parent = $entry->getParent();
		if($parent) {
			$rootId = $parent->getRootId();
			$entry->setRootId($rootId);
		}
	}
	
	/**
	 * 
	 * @param Category $entry
	 */
	protected function clearRatings($entry) {
		$result = array();
		$errors = array();
		
		$count = 0;
		
		$em = $this->getDoctrine()->getManager();
		$em->getConnection()->beginTransaction();
		
		try {
			foreach ($entry->getProductCategoryAssignments() as $productCategoryAssignment) {
				$em->remove($productCategoryAssignment);
				$count++;
			}
			$em->flush();
			
			foreach ($entry->getBrandCategoryAssignments() as $brandCategoryAssignment) {
				$em->remove($brandCategoryAssignment);
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
	
	/**
	 * 
	 * @param ImportRatings $importRatings
	 */
	protected function importRatings($importRatings) {
		$result = array();
		
		$fileEntries = $this->getFileEntries($importRatings);
		
		$preparedEntries = $this->getPreparedEntries($fileEntries);
		$errors = $this->getEntriesErrors($preparedEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$preparedEntries = $this->checkDuplicates($preparedEntries);
		$errors = $this->getEntriesErrors($preparedEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$dataBaseEntries = $this->getDataBaseEntries($preparedEntries);
		$errors = $this->getEntriesErrors($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$productsCounts = $this->getProductsCounts($dataBaseEntries);
		
		$errors = $this->saveProducts($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$dataBaseEntries = $this->getPersistentProducts($dataBaseEntries);
		$errors = $this->getEntriesErrors($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$dataBaseEntries = $this->getProductCategoryAssignments($dataBaseEntries);
		
		$assignmentsCounts = $this->getAssignmentsCounts($dataBaseEntries);
		
		$errors = $this->saveProductCategoryAssignments($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
		} else {
			$result['errors'] = array();
			$result['lines'] = count($fileEntries);
			$result['productsCounts'] = $productsCounts;
			$result['assignmentsCounts'] = $assignmentsCounts;
		}
		
		return $result;
	}
	
	protected function getFileEntries($importRatings) {
		$rows = array();
		
		$file = fopen('../web' . $importRatings->getImportFile(), 'r');
		
		while( ($row = fgetcsv($file, 1024, ';')) !== FALSE ) {
			$rows[] = $row;
		}
		
		fclose($file);
		
		return $rows;
	}
	
	protected function getPreparedEntries($fileEntries) {
		$entries = array();
	
		$i = 0;
		foreach ($fileEntries as $fileEntry) {
			$i++;
	
			$entry = $this->getPreparedEntry($fileEntry, $i);
			if($entry) $entries[] = $entry;
		}
	
		return $entries;
	}
	
	protected function getPreparedEntry($fileEntry, $i) {
		$entry = array();
		$errors = array();
		
		if(count($fileEntry) <= 0) return null;
		
		$productName = count($fileEntry) > 0 ? $fileEntry[0] : '';
		if(strlen($productName) <= 0) return null;
		
		$brandName = count($fileEntry) > 1 ? $fileEntry[1] : '';
		if(strlen($brandName) <= 0) $errors[] = $this->getEmptyError($i, 'brand');
		
		$segmentName = count($fileEntry) > 2 ? $fileEntry[2] : '';
		if(strlen($segmentName) <= 0) $errors[] = $this->getEmptyError($i, 'segment');
		
		$categoryName = count($fileEntry) > 3 ? $fileEntry[3] : '';
		if(strlen($categoryName) <= 0) $errors[] = $this->getEmptyError($i, 'category');
		
		$categorySubname = count($fileEntry) > 4 ? $fileEntry[4] : '';
		
		$imageType = count($fileEntry) > 5 ? $fileEntry[5] : '';
		if(strlen($imageType) <= 0) $imageType = 'png';
		
		$imageName = count($fileEntry) > 6 ? $fileEntry[6] : '';
		if(strlen($imageName) <= 0) $imageName = strtolower($productName);
		
		$featured = count($fileEntry) > 7 && strlen($fileEntry[7]) > 0 ? true : false;
		
		$entry['lineNumber'] = $i;
		$entry['productName'] = $productName;
		$entry['brandName'] = $brandName;
		$entry['segmentName'] = $segmentName;
		$entry['categoryName'] = $categoryName;
		$entry['categorySubname'] = $categorySubname;
		$entry['imageType'] = $imageType;
		$entry['imageName'] = $imageName;
		$entry['featured'] = $featured;
		$entry['duplicate'] = false;
		$entry['errors'] = $errors;
		
		return $entry;
	}
	
	protected function checkDuplicates($preparedEntries) {
		$count = count($preparedEntries);
		
		for($i = 0; $i < $count; $i++) {
			$errors = array();
			$prevEntry = $preparedEntries[$i];
			
			$prevProductName = $prevEntry['productName'];
			$prevBrandName = $prevEntry['brandName'];
			
			for($j = $i+1; $j < $count; $j++) {
				$nextEntry = $preparedEntries[$j];
				
				$nextProductName = $nextEntry['productName'];
				$nextBrandName = $nextEntry['brandName'];
				
				if($prevProductName == $nextProductName && $prevBrandName == $nextBrandName) {
					
					$prevImageName = $prevEntry['imageName'];
					$nextImageName = $nextEntry['imageName'];
					
					$prevImageType = $prevEntry['imageType'];
					$nextImageType = $nextEntry['imageType'];
					
					if($prevImageName != $nextImageName || $prevImageType != $nextImageType) {
						$prevNumber = $prevEntry['lineNumber'];
						$nextNumber = $nextEntry['lineNumber'];
						$errors[] = $this->getInconsistentDataError($prevNumber, $nextNumber, $prevBrandName, $prevProductName);
					}
					
					$prevCategoryName = $prevEntry['categoryName'];
					$nextCategoryName = $nextEntry['categoryName'];
					
					if($prevCategoryName == $nextCategoryName) {
						$prevCategorySubname = $prevEntry['categorySubname'];
						$nextCategorySubname = $nextEntry['categorySubname'];
						
						if($prevCategorySubname == $nextCategorySubname) {
							$prevNumber = $prevEntry['lineNumber'];
							$nextNumber = $nextEntry['lineNumber'];
							$errors[] = $this->getSameCategoryError($prevNumber, $nextNumber, $prevBrandName, $prevProductName, $prevCategoryName, $prevCategorySubname);
						}
					}
					
					$nextEntry['duplicate'] = true;
					$preparedEntries[$j] = $nextEntry;
				}
			}
			
			$prevEntry['errors'] = $errors;
			$preparedEntries[$i] = $prevEntry;
		}
		
		return $preparedEntries;
	}
	
	protected function getDataBaseEntries($preparedEntries) {
		$entries = array();
		
		foreach ($preparedEntries as $preparedEntry) {
			if(!$preparedEntry['duplicate']) {
				$entries[] = $this->getDataBaseEntry($preparedEntry);
			}
		}
		
		return $entries;
	}
	
	protected function getDataBaseEntry($preparedEntry) {
		$entry = array();
		$errors = array();
		
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$productRepository = $this->getDoctrine()->getRepository(Product::class);
		
		$brandName = $preparedEntry['brandName'];
		$brand = $brandRepository->findOneBy(['name' => $brandName]);
		if(!$brand) $errors[] = $this->getNotExistsError($preparedEntry['lineNumber'], 'brand', $brandName);
		else $entry['brand'] = $brand;
		
		
		$segmentName = $preparedEntry['segmentName'];
		$segment = $segmentRepository->findOneBy(['name' => $segmentName]);
		if(!$segment) $errors[] = $this->getNotExistsError($preparedEntry['lineNumber'], 'segment', $segmentName);
		else $entry['segment'] = $segment;
		
		
		$categoryName = $preparedEntry['categoryName'];
		$categorySubname = $preparedEntry['categorySubname'];
		$queryParams = ['name' => $categoryName];
		if(strlen($categorySubname) > 0) $queryParams['subname'] = $categorySubname;
		
		$category = $categoryRepository->findOneBy($queryParams);
		if(!$category) $errors[] = $this->getNotExistsError($preparedEntry['lineNumber'], 'category', $categoryName, $categorySubname);
		else $entry['category'] = $category;
		
		
		if($brand) {
			$productName = $preparedEntry['productName'];
			$imageName = $preparedEntry['imageName'];
			$imageType = $preparedEntry['imageType'];
			
			$product = $productRepository->findOneBy(['name' => $productName, 'brand' => $brand]);
			if(!$product) {
				$product = new Product();
				$product->setName($productName);
				$product->setInfomarket(true);
				$product->setInfoprodukt(true);
				$product->setBrand($brand);
				
				$image = $this->getImage($product, $imageName, $imageType);
				
				$product->setImage($image);
				$product->setMimeType('image/' . $imageType);
				
				$entry['productForUpdate'] = !$preparedEntry['duplicate'];
			} else {
				$image = $this->getImage($product, $imageName, $imageType);
				
				if($product->getImage() != $image) {
					$product->setImage($image);
					$product->setMimeType('image/' . $imageType);
					$entry['productForUpdate'] = true;
				} else {
					$entry['productForUpdate'] = false;
				}
			}
			
			$entry['product'] = $product;
		}
		
		$entry['featured'] = $preparedEntry['featured'];
		
		$entry['errors'] = $errors;
		return $entry;
	}
	
	protected function saveProducts($dataBaseEntries) {
		$errors = array();
		
		$em = $this->getDoctrine()->getManager();
		$em->getConnection()->beginTransaction();
		
		try {
			foreach ($dataBaseEntries as $dataBaseEntry) {
				$forUpdate = $dataBaseEntry['productForUpdate'];
				
				if($forUpdate) {
					$product = $dataBaseEntry['product'];
					$em->persist($product);
				}
			}
			$em->flush();
			$em->getConnection()->commit();
		} catch (Exception $ex) {
			$em->getConnection()->rollback();
			$errors[] = $ex->getMessage();
		}
		
		return $errors;
	}
	
	protected function getPersistentProducts($dataBaseEntries) {
		$productRepository = $this->getDoctrine()->getRepository(Product::class);
		
		$count = count($dataBaseEntries);
		for ($i = 0; $i < $count; $i++) {
			$dataBaseEntry = $dataBaseEntries[$i];
			$product = $dataBaseEntry['product'];
			
			if($product->getId() <= 0) {
				$errors = array();
				$brand = $dataBaseEntry['brand'];
				$productName = $product->getName();
				
				$product = $productRepository->findOneBy(['name' => $product->getName(), 'brand' => $brand]);
				if(!$product) $errors[] = 'Produkt ' . $brand->getName() . ' ' . $productName . ' nie zosta� poprawnie zapisany.';
				else $dataBaseEntry['product'] = $product;
				
				$dataBaseEntry['errors'] = $errors;
				$dataBaseEntries[$i] = $dataBaseEntry;
			}
		}
		
		return $dataBaseEntries;
	}
	
	protected function getProductCategoryAssignments($dataBaseEntries) {
		$assignmentRepository = $this->getDoctrine()->getRepository(ProductCategoryAssignment::class);
	
		$count = count($dataBaseEntries);
		for ($i = 0; $i < $count; $i++) {
			$dataBaseEntry = $dataBaseEntries[$i];
			
			$product = $dataBaseEntry['product'];
			$segment = $dataBaseEntry['segment'];
			$category = $dataBaseEntry['category'];
			$featured = $dataBaseEntry['featured'];

			$assignment = $assignmentRepository->findOneBy(['product' => $product, 'category' => $category]);
			
			if(!$assignment) {
				$assignment = new ProductCategoryAssignment();
				
				$assignment->setProduct($product);
				$assignment->setSegment($segment);
				$assignment->setCategory($category);
				$assignment->setFeatured($featured);
				$assignment->setOrderNumber(99);
				
				$dataBaseEntry['assignmentForUpdate'] = true;
			} else if($assignment->getSegment()->getId() != $segment->getId()) {
				$assignment->setSegment($segment);
				$dataBaseEntry['assignmentForUpdate'] = true;
			} else {
				$dataBaseEntry['assignmentForUpdate'] = false;
			}
			
			$dataBaseEntry['assignment'] = $assignment;
			
			$dataBaseEntries[$i] = $dataBaseEntry;
		}
	
		return $dataBaseEntries;
	}
	
	protected function saveProductCategoryAssignments($dataBaseEntries) {
		$errors = array();
	
		$em = $this->getDoctrine()->getManager();
		$em->getConnection()->beginTransaction();
	
		try {
			foreach ($dataBaseEntries as $dataBaseEntry) {
				$forUpdate = $dataBaseEntry['assignmentForUpdate'];
				
				if($forUpdate) {
					$assignment = $dataBaseEntry['assignment'];
					$em->persist($assignment);
				}
			}
			$em->flush();
			$em->getConnection()->commit();
		} catch (Exception $ex) {
			$em->getConnection()->rollback();
			$errors[] = $ex->getMessage();
		}
	
		return $errors;
	}
	
	protected function getProductsCounts($dataBaseEntries) {
		$counts = array();
		
		$all = 0;
		$created = 0;
		$updated = 0;
		$duplicates = 0;
		
		foreach ($dataBaseEntries as $dataBaseEntry) {
			$all++;
			
			if($dataBaseEntry['productForUpdate']) {
				$product = $dataBaseEntry['product'];
				if($product->getId() <= 0) $created++;
				else $updated++;
			} else {
				$product = $dataBaseEntry['product'];
				if($product->getId() <= 0) $duplicates++;
			}
		}
		
		$counts['all'] = $all;
		$counts['created'] = $created;
		$counts['updated'] = $updated;
		$counts['duplicates'] = $duplicates;
		
		return $counts;
	}
	
	protected function getAssignmentsCounts($dataBaseEntries) {
		$counts = array();
	
		$all = 0;
		$created = 0;
		$updated = 0;
	
		foreach ($dataBaseEntries as $dataBaseEntry) {
			$all++;
				
			if($dataBaseEntry['assignmentForUpdate']) {
				$assignment = $dataBaseEntry['assignment'];
				if($assignment->getId() <= 0) $created++;
				else $updated++;
			}
		}
	
		$counts['all'] = $all;
		$counts['created'] = $created;
		$counts['updated'] = $updated;
	
		return $counts;
	}
	
	protected function getEntriesErrors($entries) {
		$errors = array();
	
		foreach ($entries as $entry) {
			$entryErrors = $entry['errors'];
			if(count($entryErrors) > 0) {
				$errors = array_merge($errors, $entryErrors);
			}
		}
		
		return $errors;
	}
	
	protected function getNotExistsError($lineNumber, $entryType, $entryName, $entrySubname = null) {
		$translator = $this->get('translator');

		$lineMsg = $this->getLineError($lineNumber);
		
		$errorMsg = $translator->trans('error.importRatings.' . $entryType . '.notExists');
		$errorMsg = str_replace('%name%', $entryName, $errorMsg);
		if($entrySubname) $errorMsg = str_replace('%subname%', $entrySubname, $errorMsg);
		else $errorMsg = str_replace(' %subname%', '', $errorMsg);
		
		return $lineMsg . $errorMsg;
	}
	
	protected function getEmptyError($lineNumber, $entryType) {
		$translator = $this->get('translator');
		
		$lineMsg = $this->getLineError($lineNumber);
		
		$errorMsg = $translator->trans('error.importRatings.' . $entryType . '.empty');
		
		return $lineMsg . $errorMsg;
	}
	
	protected function getLineError($lineNumber) {
		$translator = $this->get('translator');
		
		$lineMsg = $translator->trans('error.importRatings.lineNumber');
		$lineMsg = str_replace('%number%', $lineNumber, $lineMsg);
		
		return $lineMsg;
	}
	
	
	
	protected function getInconsistentDataError($prevNumber, $nextNumber, $brandName, $productName) {
		$translator = $this->get('translator');
	
		$lineMsg = $this->getLinesError($prevNumber, $nextNumber);
	
		$errorMsg = $translator->trans('error.importRatings.product.inconsistentData');
		$errorMsg = str_replace('%brandName%', $brandName, $errorMsg);
		$errorMsg = str_replace('%productName%', $productName, $errorMsg);
	
		return $lineMsg . $errorMsg;
	}
	
	protected function getSameCategoryError($prevNumber, $nextNumber, $brandName, $productName, $categoryName, $categorySubname) {
		$translator = $this->get('translator');
	
		$lineMsg = $this->getLinesError($prevNumber, $nextNumber);
	
		$errorMsg = $translator->trans('error.importRatings.product.sameCategory');
		$errorMsg = str_replace('%brandName%', $brandName, $errorMsg);
		$errorMsg = str_replace('%productName%', $productName, $errorMsg);
		$errorMsg = str_replace('%categoryName%', $categoryName, $errorMsg);
		if(strlen($categorySubname) > 0) $errorMsg = str_replace('%categorySubname%', $categorySubname, $errorMsg);
		else $errorMsg = str_replace(' %categorySubname%', '', $errorMsg);
	
		return $lineMsg . $errorMsg;
	}
	
	protected function getLinesError($prevNumber, $nextNumber) {
		$translator = $this->get('translator');
	
		$lineMsg = $translator->trans('error.importRatings.lineNumbers');
		$lineMsg = str_replace('%prevNumber%', $prevNumber, $lineMsg);
		$lineMsg = str_replace('%nextNumber%', $nextNumber, $lineMsg);
	
		return $lineMsg;
	}
	
	
	
	
	protected function getImage($product, $imageName, $imageType) {
		return ClassUtils::getCleanPath($product->getUploadPath()) . '/' . ClassUtils::getCleanName($imageName) . '.' . $imageType;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new CategoryEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new CategoryManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new CategoryFilter());
	}
	
	//---------------------------------------------------------------------------
	// Params
	//---------------------------------------------------------------------------
	/**
	 *
	 * @param array $params
	 * @return array
	 */
	protected function getTreeParams(Request $request, array $params) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getTreeParams($request, $params);
	
		return $params;
	}
	
	protected function getRatingsParams(Request $request, array $params, $id)
	{
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getRatingsParams($request, $params, $id);
	
		return $params;
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::deleteMore()
	 */
	protected function deleteMore($entry)
	{
		$em = $this->getDoctrine()->getManager();
		foreach ($entry->getBranchCategoryAssignments() as $branchCategoryAssignment) {
			$em->remove($branchCategoryAssignment);
		}
		$em->flush();
	
		return array();
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return Category::class;
	}
	
	
	//---------------------------------------------------------------------------
	// Forms
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return CategoryEditorType::class;
	}

	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return CategoryFilterType::class;
	}
	
	//---------------------------------------------------------------------------
	// Views
	//---------------------------------------------------------------------------
	
	protected function getTreeView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/tree.html.twig';
	}
	
	protected function getRatingsView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/ratings.html.twig';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getTreeRoute()
    {
    	return $this->getIndexRoute() . '_tree';
    }
    
    protected function getRatingsRoute()
    {
    	return $this->getIndexRoute() . '_ratings';
    }
    
    protected function getSetPreleafRoute()
    {
    	return $this->getIndexRoute() . '_set_preleaf';
    }
}