<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Entity\Product;
use AppBundle\Filter\Benchmark\BenchmarkQueryFilter;
use AppBundle\Form\Benchmark\BenchmarkQueryType;
use AppBundle\Form\Filter\Benchmark\BenchmarkQueryFilterType;
use AppBundle\Manager\Entity\Benchmark\BenchmarkQueryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
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
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalContextParamsManager($doctrine, $lastRouteParams) {
		return new ContextParamsManager($doctrine, $lastRouteParams);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new BenchmarkQueryManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		
		$filter = new BenchmarkQueryFilter();
		$filter->setCreatedBy([$user]);
		
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