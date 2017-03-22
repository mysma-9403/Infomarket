<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Base\DummyController;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Form\Benchmark\CategoryFilterType;
use AppBundle\Form\Benchmark\ProductFilterType;
use AppBundle\Form\Benchmark\SubcategoryFilterType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\ProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Validator\Constraints\Date;

class BenchmarkController extends DummyController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}
	
	public function exportToCsvAction(Request $request, $page) {
		return $this->exportToCsvActionInternal($request, $page);
	}
	
	public function exportToHtmlAction(Request $request, $page) {
		return $this->exportToHtmlActionInternal($request, $page);
	}
	
	public function exportToExcelAction(Request $request, $page) {
		return $this->exportToExcelActionInternal($request, $page);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::indexActionInternal()
	 */
	protected function indexActionInternal(Request $request, $page)
	{
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		
		
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		//TODO refactor forms like in other controllers
		$category = $contextParams['category'];
		$categoryFilter = new CategoryFilter();
		$categoryFilter->setCategory($category);

		$categoryFilterForm = $this->createForm(CategoryFilterType::class, $categoryFilter);
		$categoryFilterForm->handleRequest($request);

		if ($categoryFilterForm->isSubmitted() && $categoryFilterForm->isValid()) {
			if ($categoryFilterForm->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $categoryFilter->getRequestValues());
			}
		}
		$viewParams['categoryFilter'] = $categoryFilterForm->createView();		
		
		
		$subcategory = $contextParams['subcategory'];
		$subcategoryFilter = new SubcategoryFilter();
		$subcategoryFilter->setSubcategory($subcategory);
		
		$subcategoryFilterForm = $this->createForm(SubcategoryFilterType::class, $subcategoryFilter, ['category' => $category]);
		$subcategoryFilterForm->handleRequest($request);
		
		if ($subcategoryFilterForm->isSubmitted() && $subcategoryFilterForm->isValid()) {
			if ($subcategoryFilterForm->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $subcategoryFilter->getRequestValues());
			}
		}
		$viewParams['subcategoryFilter'] = $subcategoryFilterForm->createView();
		
		
		/** @var ProductFilter $filter */
		$filter = $viewParams['entryFilter'];
	
		$filterForm = $this->createForm($this->getFilterFormType(), $filter, ['category' => $subcategory, 'fields' => $filter->getFilterFields()]);
		$filterForm->handleRequest($request);
	
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
			
			if ($filterForm->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
			
			if ($filterForm->get('clear')->isClicked()) {
				$filter->clearRequestValues();
				return $this->redirectToRoute($this->getIndexRoute(), $filter->getRequestValues());
			}
		}
		$viewParams['filter'] = $filterForm->createView();
		
		$routeParams = $params['routeParams'];
		$viewParams['routeParams'] = $routeParams;
		
		return $this->render($this->getIndexView(), $viewParams);
	}
	
	protected function exportToCsvActionInternal(Request $request, $page) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		$entries = $viewParams['entries'];
		/** @var ProductFilter $entryFilter */
		$entryFilter = $viewParams['entryFilter'];
		
		$response = new StreamedResponse();
		$response->setCallback(function() use(&$entryFilter, &$entries) {
			$handle = fopen('php://output', 'w+');
			
			if(count($entries) > 0) {
				
				$fields = array();
				foreach ($entries as $entry) {
					$fields[] = $entry['brandName'];
				}
				fputs($handle, implode($fields, ';')."\n");
				
				$fields = array();
				foreach ($entries as $entry) {
					$fields[] = $entry['name'];
				}
				fputs($handle, implode($fields, ';')."\n");
				
				$fields = array();
				foreach ($entries as $entry) {
					$fields[] = 'http://infomarket.edu.pl/' . $entry['image'];
				}
				fputs($handle, implode($fields, ';')."\n");
				
				foreach ($entryFilter->getShowFields() as $showField) {
					$value = BenchmarkField::getValueTypeDBName($showField['valueType']) . $showField['valueNumber'];
					
					$fields = array();
					foreach ($entries as $entry) {
						$fields[] = str_replace("\n", "", $entry[$value]);
					}
					fputs($handle, implode($fields, ';')."\n");
				}
				
			} else {
				fputcsv($handle, array(''), ';');
			}
	
			fclose($handle);
		});
	
		$date = new \DateTime();
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'text/csv; charset=utf-8');
		$response->headers->set('Content-Disposition', 'attachment; filename="'. $date->format('Y-m-d') . '-benchmark.csv"');

		return $response;
	}
	
	protected function exportToHtmlActionInternal(Request $request, $page) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
	
		$viewParams = $params['viewParams'];
		$entries = $viewParams['entries'];
		/** @var ProductFilter $entryFilter */
		$entryFilter = $viewParams['entryFilter'];
	
		$response = new StreamedResponse();
		$response->setCallback(function() use(&$entryFilter, &$entries) {
		
			$handle = fopen('php://output', 'w+');
		
			$date = new \DateTime();
			
			fputs($handle, "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
			fputs($handle, "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");
			fputs($handle, "<head>\n");
			fputs($handle, "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n");
			fputs($handle, "<title>Benchmark " . $date->format('d.m.Y') . "</title>\n");
			fputs($handle, "</head>\n");
			fputs($handle, "<body>\n");
	        
			if(count($entries) > 0) {
				
				//TODO generate some template file or sth??
				fputs($handle, "<table>\n");
				
				fputs($handle, "<tr><th width=\"200\" style=\"text-align: right;\"></th>\n");
				foreach ($entries as $entry) {
					fputs($handle, "<td width=\"200\"><img width=\"100%\" style=\"max-width: 200px;\" src='http://infomarket.edu.pl/" . $entry['image'] . "'></td>\n");
				}
				fputs($handle, "<td></td></tr>\n");
				
				fputs($handle, "<tr><th style=\"text-align: right;\">Marka</th>\n");
				foreach ($entries as $entry) {
					fputs($handle, "<td style=\"text-align: center;\">" . $entry['brandName'] . "</td>\n");
				}
				fputs($handle, "<td></td></tr>\n");
				
				fputs($handle, "<tr><th style=\"text-align: right;\">Symbol</th>\n");
				foreach ($entries as $entry) {
					fputs($handle, "<td style=\"text-align: center;\">" . $entry['name'] . "</td>\n");
				}
				fputs($handle, "<td></td></tr>\n");
	
				foreach ($entryFilter->getShowFields() as $showField) {
					$value = BenchmarkField::getValueTypeDBName($showField['valueType']) . $showField['valueNumber'];
						
					fputs($handle, "<tr><th style=\"text-align: right;\">" . $showField['fieldName'] . "</th>\n");
					foreach ($entries as $entry) {
						switch($showField['fieldType']) {
							case BenchmarkField::BOOLEAN_FIELD_TYPE:
								fputs($handle, "<td style=\"text-align: center;\">" . ($entry[$value] ? "+" : "-") . "</td>\n");
								break;
							default:
								fputs($handle, "<td style=\"text-align: center;\">" . $entry[$value] . "</td>\n");
								break;
						}
					}
					fputs($handle, "<td></td></tr>\n");
				}
				
				fputs($handle, "</table>\n");
			}
			
			fputs($handle, "</body>\n");
	
			fclose($handle);
		});
	
		$date = new \DateTime();
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'text/csv; charset=utf-8');
		$response->headers->set('Content-Disposition', 'attachment; filename="'. $date->format('Y-m-d') . '-benchmark.html"');

		return $response;
	}
	
	protected function exportToExcelActionInternal(Request $request, $page) {
		$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getIndexRoute());
		$params = $this->getIndexParams($request, $params, $page);
	
		$viewParams = $params['viewParams'];
		$entries = $viewParams['entries'];
		/** @var ProductFilter $entryFilter */
		$entryFilter = $viewParams['entryFilter'];
	
		$response = new StreamedResponse();
		$response->setCallback(function() use(&$entryFilter, &$entries) {
			
			$date = new \DateTime();
			
			$excel = new \PHPExcel();
				
			$excel->getProperties()
			->setCreator("Infomarket")
			->setLastModifiedBy("Infomarket")
			->setTitle($date->format('Y-m-d') . " - benchmark")
			->setSubject("InfoMarket - Benchmark")
			->setDescription("InfoMarket - Benchmark")
			->setKeywords("InfoMarket benchmark products");
			
			if(count($entries) > 0) {
	
				$sheet = $excel->getActiveSheet();
				
				$sheet->getRowDimension(1)->setRowHeight(120);
				
				$sheet->getColumnDimensionByColumn(0)->setWidth(50);
				
				$cell = $sheet->getCellByColumnAndRow(0, 2);
				$cell->setValue('Marka');
				$cell->getStyle()->getFont()->setBold(true);
				$cell->getStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				
				$cell = $sheet->getCellByColumnAndRow(0, 3);
				$cell->setValue('Symbol');
				$cell->getStyle()->getFont()->setBold(true);
				$cell->getStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				
				$row = 4;
				foreach ($entryFilter->getShowFields() as $showField) {
					$cell = $sheet->getCellByColumnAndRow(0, $row);
					$cell->setValue($showField['fieldName']);
					$cell->getStyle()->getFont()->setBold(true);
					$cell->getStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					
					$row++;
				}
					
				$col = 1;
				foreach ($entries as $entry) {
					$sheet->getColumnDimensionByColumn($col)->setWidth(24);
					
					$cell = $sheet->getCellByColumnAndRow($col, 1);
					
					$image = $entry['image'];
					if($image && file_exists($image)) {
						$drawing = new \PHPExcel_Worksheet_Drawing();
						$drawing->setPath($image);
						$drawing->setCoordinates($cell->getCoordinate());
						$drawing->setWorksheet($sheet);
						$drawing->setResizeProportional(true);
						$drawing->setWidth(110);
						$drawing->setOffsetX(30);
						$drawing->setOffsetY(5);
					}
					
					$cell = $sheet->getCellByColumnAndRow($col, 2);
					$cell->setValue($entry['brandName']);
					$cell->getStyle()->getFont()->setBold(true);
					$cell->getStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					$cell = $sheet->getCellByColumnAndRow($col, 3);
					$cell->setValue($entry['name']);
					$cell->getStyle()->getFont()->setBold(true);
					$cell->getStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					$col++;
				}
				
				$row = 4;
				foreach ($entryFilter->getShowFields() as $showField) {
					$value = BenchmarkField::getValueTypeDBName($showField['valueType']) . $showField['valueNumber'];
				
					$col = 1;
					foreach ($entries as $entry) {
						
						$cell = $sheet->getCellByColumnAndRow($col, $row);
						
						switch($showField['fieldType']) {
							case BenchmarkField::BOOLEAN_FIELD_TYPE:
								$val = $entry[$value] ? "+" : "-";
								break;
							default:
								$val = $entry[$value];
								break;
						}
						
						$cell->setValue($val);
						$cell->getStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$cell->getStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);
						$cell->getStyle()->getAlignment()->setWrapText(true);
						
						$col++;
					}
					$row++;
				}
	
			} else {
				$excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "No entries found.");
			}
			
			$writer = new \PHPExcel_Writer_Excel2007($excel);
			$writer->setOffice2003Compatibility(true);
			$writer->save('php://output');
		});
	
		$date = new \DateTime();
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$response->headers->set('Content-Disposition', 'attachment; filename="'. $date->format('Y-m-d') . '-benchmark.xlsx"');

		return $response;
	}
	
	//---------------------------------------------------------------------------
	// Parameters
	//---------------------------------------------------------------------------
	
	protected function getParams(Request $request, array $params) {
		$params = parent::getParams($request, $params);
	
		$cpm = $this->getContextParamsManager($request);
		$params = $cpm->getParams($request, $params);
	
		return $params;
	}
	
	protected function getIndexParams(Request $request, array $params, $page) {
		$params = $this->getParams($request, $params);
	
		$em = $this->getEntryParamsManager();
		$params = $em->getIndexParams($request, $params, $page);
	
		return $params;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getContextParamsManager(Request $request) {
		$doctrine = $this->getDoctrine();
	
		$rm = new RouteManager();
		$lastRoute = $rm->getLastRoute($request, $this->getHomeRoute());
		$lastRouteParams = $lastRoute['routeParams'];
	
		if(!$lastRouteParams) {
			$lastRouteParams = array();
		}
	
		return new ContextParamsManager($doctrine, $lastRouteParams);
	}
	
	protected function getEntryParamsManager() { 
		$doctrine = $this->getDoctrine();
		$paginator = $this->get('knp_paginator');
	
		$em = $this->getEntityManager($doctrine, $paginator);
		$fm = $this->getFilterManager($doctrine);
	
		return $this->getInternalEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new EntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		$em = $doctrine->getManager();
		$repository = new ProductRepository($em, $em->getClassMetadata(Product::class));
		
		return new ProductManager($doctrine, $paginator, $repository);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		$em = $doctrine->getManager();
		$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
		
		return new FilterManager(new ProductFilter($benchmarkFieldRepository));
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function getFilterFormType() {
		return ProductFilterType::class;
	}
	
	protected function getEntityType() {
		return Product::class;
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getShowRole() {
		return 'ROLE_BENCHMARK';
	}
	
	//---------------------------------------------------------------------------
	// Views
	//---------------------------------------------------------------------------
	
	protected function getIndexView()
	{
		return $this->getDomain() . '/' . $this->getEntityName() . '/index.html.twig';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getIndexRoute()
	{
		return $this->getDomain() . '_' . $this->getEntityName();
	}
	
	protected function getHomeRoute() {
		return array('route' => $this->getIndexView(), 'routeParams' => array());
	}
	
	
	//---------------------------------------------------------------------------
	// Domain
	//---------------------------------------------------------------------------
	
	protected function getDomain() {
		return 'benchmark';
	}
}