<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Entity\Product;
use AppBundle\Filter\Benchmark\BenchmarkQueryFilter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Form\Benchmark\BenchmarkQueryType;
use AppBundle\Form\Filter\Benchmark\BenchmarkQueryFilterType;
use AppBundle\Manager\Entity\Benchmark\BenchmarkQueryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Utils\StringUtils;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkQueryController extends BaseEntityController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}
	
	public function newAction(Request $request) {
		return $this->newActionInternal($request);
	}
	
	public function editAction(Request $request, $id) {
		return $this->editActionInternal($request, $id);
	}
	
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}
	
	public function deleteAction(Request $request, $id) {
		return $this->deleteActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	protected function showActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getShowRoute());
		$params = $this->getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		
		$entity = $viewParams['entry'];
		
		$url = $this->generateUrl($this->getProductsIndexRoute());
		$url .= '?' . $entity->getContent();
		
		$benchmarkQuery = $request->get('product_benchmark_query', null);
		if($benchmarkQuery) $url .= '&product_benchmark_query=' . $benchmarkQuery;
		
		return $this->redirect($url);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getListItemKeyFields($item) {
		$fields = parent::getListItemKeyFields($item);
		
		$fields[] = $item['name'];
		
		return $fields;
	}
	
	protected function saveMore($request, $entry, $params) {
		parent::saveMore($request, $entry, $params);
		
		/** @var BenchmarkQuery $entry */
		if($entry->getArchived() && count($entry->getProducts()) <= 0) {
			$contextParams = $params['contextParams'];
			
			/** @var \Doctrine\Common\Persistence\ObjectManager $em */
			$em = $this->getDoctrine()->getManager();
			$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
			$productFilter = new ProductFilter($benchmarkFieldRepository);
			$productFilter->initContextParams($contextParams);
			$productFilter->initRequestValues($request);
			
			$productRepository = new ProductRepository($em, $em->getClassMetadata(Product::class));
			$products = $productRepository->findItems($productFilter);
			
			foreach ($products as $product) {
				/** @var Product $archived */
				$archived = $productRepository->find($product['id']);
				
				$em->detach($archived);
				
				$archived->setBenchmarkQuery($entry);
				$archived->setCreatedAt(null);
				$archived->setCreatedBy(null);
				$archived->setUpdatedAt(null);
				$archived->setUpdatedBy(null);
				$archived->setInfomarket(false);
				$archived->setInfoprodukt(false);
				$archived->setId(null);
				
				$em->persist($archived);
			}
			$em->flush();
		}
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalContextParamsManager($doctrine, $lastRouteParams) {
		$tokenStorage = $this->get('security.token_storage');
		return new ContextParamsManager($doctrine, $lastRouteParams, $tokenStorage);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new BenchmarkQueryManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		
		$filter = new BenchmarkQueryFilter();
		$filter->setContextUser($user);
		
		return new FilterManager($filter);
	}
		
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getProductsIndexRoute()
	{
		return $this->getDomain() . '_' . StringUtils::getClassName(Product::class);
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getShowRole() {
		return 'ROLE_BENCHMARK';
	}
	
	protected function getEditRole() {
		return 'ROLE_BENCHMARK';
	}
	
	protected function getDeleteRole() {
		return 'ROLE_BENCHMARK';
	}
	
	//---------------------------------------------------------------------------
	// Permissions
	//---------------------------------------------------------------------------
	
	protected function canCreate() {
		return false;
	}
	
	protected function canCopy() {
		return false;
	}
	
	protected function isAdmin() {
		return false;
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function getEditorFormType() {
		return BenchmarkQueryType::class;
	}
	
	protected function getFilterFormType() {
		return BenchmarkQueryFilterType::class;
	}
	
	protected function getEntityType() {
		return BenchmarkQuery::class;
	}
	
	//---------------------------------------------------------------------------
	// Domain
	//---------------------------------------------------------------------------
	
	protected function getDomain() {
		return 'benchmark';
	}
}