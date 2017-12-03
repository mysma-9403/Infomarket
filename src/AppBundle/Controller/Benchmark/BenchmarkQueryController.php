<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Admin\Base\BaseController;
use AppBundle\Entity\Main\BenchmarkQuery;
use AppBundle\Entity\Main\Product;
use AppBundle\Filter\Benchmark\BenchmarkQueryFilter;
use AppBundle\Form\Editor\Benchmark\BenchmarkQueryEditorType;
use AppBundle\Form\Filter\Benchmark\BenchmarkQueryFilterType;
use AppBundle\Manager\Entity\Benchmark\BenchmarkQueryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Utils\ClassUtils;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkQueryController extends BaseController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
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
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	protected function showActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getShowRoute());
		$params = $this->getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		
		$entity = $viewParams['entry'];
		
		$url = $this->generateUrl($this->getProductsIndexRoute());
		$url .= '?' . $entity->getContent();
		
		$benchmarkQuery = $request->get('product_benchmark_query', null);
		if ($benchmarkQuery)
			$url .= '&product_benchmark_query=' . $benchmarkQuery;
		
		return $this->redirect($url);
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.name_list_items_provider');
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getContextParamsManager(Request $request) {
		return $this->get(ContextParamsManager::class);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(BenchmarkQueryManager::class);
	}

	protected function getFilterManager($doctrine) {
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		
		$filter = new BenchmarkQueryFilter();
		$filter->setContextUser($user);
		
		return new FilterManager($filter);
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getProductsIndexRoute() {
		return $this->getDomain() . '_' . ClassUtils::getUnderscoreName(Product::class);
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_USER';
	}

	protected function getEditRole() {
		return $this->getShowRole();
	}

	protected function getDeleteRole() {
		return $this->getEditRole();
	}
	
	// ---------------------------------------------------------------------------
	// Permissions
	// ---------------------------------------------------------------------------
	protected function canCreate() {
		return false;
	}

	protected function isAdmin() {
		return false;
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEditorFormType() {
		return BenchmarkQueryEditorType::class;
	}

	protected function getFilterFormType() {
		return BenchmarkQueryFilterType::class;
	}

	protected function getEntityType() {
		return BenchmarkQuery::class;
	}
	
	// ---------------------------------------------------------------------------
	// Domain
	// ---------------------------------------------------------------------------
	protected function getDomain() {
		return 'benchmark';
	}
}