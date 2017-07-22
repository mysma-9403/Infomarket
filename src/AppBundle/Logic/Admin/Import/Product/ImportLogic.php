<?php

namespace AppBundle\Logic\Admin\Import\Product;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Other\ImportRatings;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Entity\Segment;
use AppBundle\Factory\Admin\ErrorFactory;
use AppBundle\Factory\Admin\Import\Product\ImportErrorFactory;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use AppBundle\Utils\StringUtils;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ImportLogic {
	
	/**
	 * 
	 * @var Registry
	 */
	protected $doctrine;
	
	/**
	 *
	 * @var ImportErrorFactory
	 */
	protected $errorFactory;
	
	/**
	 * 
	 * @var BenchmarkFieldDataBaseUtils
	 */
	protected $benchmarkFieldDataBaseUtils;
	
	public function __construct(Registry $doctrine, ImportErrorFactory $errorFactory, BenchmarkFieldDataBaseUtils $benchmarkFieldDataBaseUtils) {
		$this->doctrine = $doctrine;
		$this->errorFactory = $errorFactory;
		$this->benchmarkFieldDataBaseUtils = $benchmarkFieldDataBaseUtils;
	}
	
	
	
	/**
	 *
	 * @param ImportRatings $importRatings
	 */
	public function importRatings($importRatings, $category) {
		$result = array();
	
		$fileEntries = $this->getFileEntries($importRatings);
		
		$errors = $this->validateCategory($fileEntries, $category);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$columns = $this->getHeaderColumns($fileEntries);
		$errors = $columns['errors'];
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		$columns = $columns['items'];
		
		$errors = $this->validateColumns($columns);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$fileEntries = $this->removeHeaderColumns($fileEntries);
		
		$preparedEntries = $this->getPreparedEntries($fileEntries, $columns);
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
	
		$dataBaseEntries = $this->getDataBaseEntries($preparedEntries, $category, $columns);
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
			return $result;
		}
		
		$brandsCounts = $this->getBrandsCounts($dataBaseEntries);
		
		$errors = $this->saveBrands($dataBaseEntries);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$dataBaseColumns = $this->getDataBaseColumns($category, $columns);
		$errors = $this->getEntriesErrors($dataBaseColumns);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$benchmarkFieldsCounts = $this->getColumnsCounts($dataBaseColumns);
		
		$errors = $this->saveColumns($dataBaseColumns);
		if (count($errors) > 0) {
			$result['errors'] = $errors;
			return $result;
		}
		
		$result['errors'] = array();
		$result['lines'] = count($fileEntries);
		$result['brandsCounts'] = $brandsCounts;
		$result['productsCounts'] = $productsCounts;
		$result['assignmentsCounts'] = $assignmentsCounts;
		$result['benchmarkFieldsCounts'] = $benchmarkFieldsCounts;
	
		return $result;
	}
	
	protected function getFileEntries($importRatings) {
		$rows = array();
	
		$fileName = urldecode($importRatings->getImportFile());
		
		$file = fopen('../web' . $fileName, 'r');
	
		while( ($row = fgetcsv($file, 2048, ';')) !== FALSE ) {
			$rows[] = $row;
		}
	
		fclose($file);
	
		return $rows;
	}
	
	protected function validateCategory($fileEntries, $category) {
		$errors = array();
	
		$columns = $fileEntries[0];
		$categoryName = $columns[0];
		$categorySubname = $columns[1];
		if($category->getName() != $categoryName || $category->getSubname() != $categorySubname) {
			$errors[] = $this->errorFactory->createInvalidCategoryError(
					$category->getName() . ' ' . $category->getSubname(), $categoryName . ' ' . $categorySubname);
		}
		
		return $errors;
	}
	
	protected function getHeaderColumns($fileEntries) {
		$errors = array();
		$items = array();
	
		$columnNames = $fileEntries[1];
		$fieldTypes = $fileEntries[2];
		$fieldNumbers = $fileEntries[3];
		$valueNumbers = $fileEntries[4];
		$showFields = $fileEntries[5];
		$showFilters = $fileEntries[6];
		$fieldNames = $fileEntries[7];
		
		$size = count($columnNames);
		
		for ($i = 0; $i < $size; $i++) {
			$columnName = $columnNames[$i];
			if($columnName && strlen($columnName) > 0) {
				$item = array();
				
				$item['index'] = $i;
				$item['name'] = $columnName;
				
				$items[$item['name']] = $item;
			} else {
				$fieldTypeName = $fieldTypes[$i];
				if($fieldTypeName && strlen($fieldTypeName) > 0) {
					
					$valueType = null;
					$fieldType = null;
					
					if($fieldTypeName == 'decimal') {
						$valueType = BenchmarkField::DECIMAL_VALUE_TYPE;
						$fieldType = BenchmarkField::DECIMAL_FIELD_TYPE;
					} else if($fieldTypeName == 'integer') {
						$valueType = BenchmarkField::INTEGER_VALUE_TYPE;
						$fieldType = BenchmarkField::INTEGER_FIELD_TYPE;
					} else if($fieldTypeName == 'boolean' || $fieldTypeName == 'bool') {
						$valueType = BenchmarkField::INTEGER_VALUE_TYPE;
						$fieldType = BenchmarkField::BOOLEAN_FIELD_TYPE;
					} else if($fieldTypeName == 'string') {
						$valueType = BenchmarkField::STRING_VALUE_TYPE;
						$fieldType = BenchmarkField::STRING_FIELD_TYPE;
					} else if($fieldTypeName == 'single enum' || $fieldTypeName == 'singleenum') {
						$valueType = BenchmarkField::STRING_VALUE_TYPE;
						$fieldType = BenchmarkField::SINGLE_ENUM_FIELD_TYPE;
					} else if($fieldTypeName == 'multi enum' || $fieldTypeName == 'multienum') {
						$valueType = BenchmarkField::STRING_VALUE_TYPE;
						$fieldType = BenchmarkField::MULTI_ENUM_FIELD_TYPE;
					}
					
					if($valueType) {
						$valueNumber = $valueNumbers[$i];
						
						$fieldNumber = $fieldNumbers[$i];
						$fieldName = trim($fieldNames[$i]);
						$showField = $showFields[$i];
						
						$filterName = $fieldName;
						$index = strpos($filterName, '[');
						if($index !== false) {
							$filterName = trim(substr($filterName, 0, $index));
						}
						$filterNumber = $fieldNumber;
						$showFilter = $showFilters[$i];
						
						$item = array();
						
						$itemName = $this->benchmarkFieldDataBaseUtils->getValueFieldProperty($valueType, $valueNumber);
						
						$item['index'] = $i;
						$item['name'] = $itemName;
						
						$item['valueType'] = $valueType;
						$item['valueNumber'] = $valueNumber;
						
						$item['fieldType'] = $fieldType;
						$item['fieldName'] = $fieldName;
						$item['fieldNumber'] = $fieldNumber;
						$item['showField'] = $showField;
						
						$item['filterName'] = $filterName;
						$item['filterNumber'] = $filterNumber;
						$item['showFilter'] = $showFilter;
						
						if(key_exists($itemName, $items)) {
							$errors[] = $this->errorFactory->createDuplicateColumnError($itemName, $i, $items[$itemName]['index']);
						} else {
							$items[$item['name']] = $item;
						}
					}
				}
			}
		}
	
		return ['items' => $items, 'errors' => $errors];
	}
	
	protected function validateColumns($columns) {
		$errors = array();
		
		if(!key_exists('productName', $columns)) {
			$errors[] = $this->errorFactory->createColumnNotExistsError('productName');
		}
		
		if(!key_exists('brandName', $columns)) {
			$errors[] = $this->errorFactory->createColumnNotExistsError('brandName');
		}
		
		return $errors;
	}
	
	protected function removeHeaderColumns($fileEntries) {
		return array_slice($fileEntries, 8);
	}
	
	protected function getPreparedEntries($fileEntries, $columns) {
		$entries = array();
	
		$i = 0;
		foreach ($fileEntries as $fileEntry) {
			$i++;
	
			$entry = $this->getPreparedEntry($fileEntry, $i, $columns);
			if($entry) $entries[] = $entry;
		}
	
		return $entries;
	}
	
	protected function getPreparedEntry($fileEntry, $i, $columns) {
		$entry = array();
		$errors = array();
	
		if(count($fileEntry) <= 0) return null;
	
		$productNameIndex = $columns['productName']['index'];
		$productName = $fileEntry[$productNameIndex];
		if(strlen($productName) <= 0) {
			return null;
		}
	
		$brandNameIndex = $columns['brandName']['index'];
		$brandName = $fileEntry[$brandNameIndex];
		if(strlen($brandName) <= 0) {
			$errors[] = $this->errorFactory->createEmptyError($i, 'brand');
		}
		
		$brandWww = null;
		if(key_exists('brandWww', $columns)) {
			$brandWwwIndex = $columns['brandWww']['index'];
			$brandWww = $fileEntry[$brandWwwIndex];
		}
		
		$productPrice = null;
		if(key_exists('productPrice', $columns)) {
			$productPriceIndex = $columns['productPrice']['index'];
			$productPrice = $fileEntry[$productPriceIndex];
		}
		
		$segmentName = null;
		if(key_exists('segmentName', $columns)) {
			$segmentNameIndex = $columns['segmentName']['index'];
			$segmentName = $fileEntry[$segmentNameIndex];
		}
	
		$imageName = strtolower($productName);
		if(key_exists('imageName', $columns)) {
			$imageNameIndex = $columns['imageName']['index'];
			$value = $fileEntry[$imageNameIndex];
			if(strlen($value) > 0) $imageName = $value;
		}
		
		$imageType = 'png';
		if(key_exists('imageType', $columns)) {
			$imageTypeIndex = $columns['imageType']['index'];
			$value = $fileEntry[$imageTypeIndex];
			if(strlen($value) > 0) $imageType = $value;
			
		}
	
		$featured = false;
		if(key_exists('featured', $columns)) {
			$featuredIndex = $columns['featured']['index'];
			$value = $fileEntry[$featuredIndex];
			$featured = strlen($value) > 0 && $value ? true : false;
		}
		
		$entry['lineNumber'] = $i;
		
		$entry['productName'] = $productName;
		$entry['brandName'] = $brandName;
		$entry['segmentName'] = $segmentName;
		
		$entry['brandWww'] = $brandWww;
		$entry['productPrice'] = $productPrice;
		
		$entry['imageName'] = $imageName;
		$entry['imageType'] = $imageType;
		
		$entry['featured'] = $featured;
		
		$entry['duplicate'] = false;
		$entry['errors'] = $errors;
		
		foreach ($columns as $column) {
			if(key_exists('valueType', $column)) {
				$value = trim($fileEntry[$column['index']]);
				if(strlen($value) < 1) {
					$value = null;
				} else {
					switch ($column['fieldType']) {
						case BenchmarkField::BOOLEAN_FIELD_TYPE:
							if($value == '-' || $value == '0') {
								$value = false;
							} else {
								$value = true;
							}
							break;
						default:
							if($value == '-') {
								$value = null;
							}
					}
				}
				
				$entry[$column['name']] = $value;
			}
		}
	
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
						$errors[] = $this->errorFactory->createInconsistentDataError($prevNumber, $nextNumber, $prevBrandName, $prevProductName);
					}
						
					$prevCategoryName = $prevEntry['categoryName'];
					$nextCategoryName = $nextEntry['categoryName'];
						
					if($prevCategoryName == $nextCategoryName) {
						$prevCategorySubname = $prevEntry['categorySubname'];
						$nextCategorySubname = $nextEntry['categorySubname'];
	
						if($prevCategorySubname == $nextCategorySubname) {
							$prevNumber = $prevEntry['lineNumber'];
							$nextNumber = $nextEntry['lineNumber'];
							$errors[] = $this->errorFactory->createSameCategoryError($prevNumber, $nextNumber, $prevBrandName, $prevProductName, $prevCategoryName, $prevCategorySubname);
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
	
	protected function getDataBaseEntries($preparedEntries, $category, $columns) {
		$entries = array();
	
		foreach ($preparedEntries as $preparedEntry) {
			if(!$preparedEntry['duplicate']) {
				$entries[] = $this->getDataBaseEntry($preparedEntry, $category, $columns);
			}
		}
	
		return $entries;
	}
	
	protected function getDataBaseEntry($preparedEntry, $category, $columns) {
		$entry = array();
		$errors = array();
		
		$brandRepository = $this->doctrine->getRepository(Brand::class);
		$segmentRepository = $this->doctrine->getRepository(Segment::class);
		$productRepository = $this->doctrine->getRepository(Product::class);
	
		$brandName = $preparedEntry['brandName'];
		$brand = $brandRepository->findOneBy(['name' => $brandName]);
		if(!$brand) $errors[] = $this->errorFactory->createNotExistsError($preparedEntry['lineNumber'], 'brand', $brandName);
		else {
			$entry['brand'] = $brand;
			
			$brandWww = $preparedEntry['brandWww'];
			if($brandWww && strlen($brandWww) > 0 && $brandWww != $brand->getWww()) {
				$brand->setWww($brandWww);
				$entry['brandForUpdate'] = true;
			} else {
				$entry['brandForUpdate'] = false;
			}
		}
	
	
		$segmentName = $preparedEntry['segmentName'];
		if($segmentName) {
			$segment = $segmentRepository->findOneBy(['name' => $segmentName]);
			if(!$segment) $errors[] = $this->errorFactory->createNotExistsError($preparedEntry['lineNumber'], 'segment', $segmentName);
			else $entry['segment'] = $segment;
		} else {
			$entry['segment'] = null;
		}
		
		$entry['category'] = $category;
	
	
		if($brand) {
			$productName = $preparedEntry['productName'];
			$imageName = $preparedEntry['imageName'];
			$imageType = $preparedEntry['imageType'];
			
			$productPrice = null;
			if(key_exists('productPrice', $preparedEntry)) $productPrice = $preparedEntry['productPrice'];
				
			$product = $productRepository->findOneBy(['name' => $productName, 'brand' => $brand]);
			if(!$product) {
				$product = new Product();
				$product->setName($productName);
				
				$product->setInfomarket(true);
				$product->setInfoprodukt(true);
				
				$product->setBrand($brand);
				$product->setPrice($productPrice);
	
				$image = $this->getImage($product, $imageName, $imageType);
	
				$product->setImage($image);
				$product->setMimeType('image/' . $imageType);
				
				foreach ($columns as $column) {
					if(key_exists('valueType', $column)) {
						$columnName = $column['name'];
						$product->offsetSet($columnName, $preparedEntry[$columnName]);
					}
				}
	
				$entry['productForUpdate'] = !$preparedEntry['duplicate'];
			} else {
				$image = $this->getImage($product, $imageName, $imageType);
	
				$forUpdate = false;
				if($product->getImage() != $image) {
					$product->setImage($image);
					$product->setMimeType('image/' . $imageType);
					$forUpdate = true;
				}
				
				if($productPrice != $product->getPrice()) {
					$product->setPrice($productPrice);
					$forUpdate = true;
				}
				
				foreach ($columns as $column) {
					if(key_exists('valueType', $column)) {
						$columnName = $column['name'];
						if($product->offsetGet($columnName) != $preparedEntry[$columnName]) {
							$product->offsetSet($columnName, $preparedEntry[$columnName]);
							$forUpdate = true;
						}
					}
				}
				
				$entry['productForUpdate'] = $forUpdate;
			}
				
			$entry['product'] = $product;
		}
	
		$entry['featured'] = $preparedEntry['featured'];
	
		$entry['errors'] = $errors;
		
		return $entry;
	}
	
	protected function getDataBaseColumns($category, $columns) {
		$result = array();
	
		foreach ($columns as $column) {
			if(key_exists('valueType', $column)) {
				$result[] = $this->getDataBaseColumn($category, $column);
			}
		}
	
		return $result;
	}
	
	protected function getDataBaseColumn($category, $column) {
		$entry = array();
		$errors = array();
	
		$benchmarkFieldRepository = $this->doctrine->getRepository(BenchmarkField::class);
	
		$valueType = $column['valueType'];
		$valueNumber = $column['valueNumber'];
		$benchmarkField = $benchmarkFieldRepository->findOneBy(['category' => $category->getId(), 'valueType' => $valueType, 'valueNumber' => $valueNumber]);
		if(!$benchmarkField) {
			$benchmarkField = new BenchmarkField();
			
			$benchmarkField->setCategory($category);
			$benchmarkField->setValueType($valueType);
			$benchmarkField->setValueNumber($valueNumber);
			
			$benchmarkField->setFieldName($column['fieldName']);
			$benchmarkField->setFieldNumber($column['fieldNumber']);
			$benchmarkField->setFieldType($column['fieldType']);
			$benchmarkField->setShowField($column['showField']);
			
			$benchmarkField->setFilterName($column['filterName']);
			$benchmarkField->setFilterNumber($column['filterNumber']);
			$benchmarkField->setFilterType($column['filterType']);
			$benchmarkField->setShowFilter($column['showFilter']);
			
			if($column['fieldType'] == BenchmarkField::DECIMAL_VALUE_TYPE) {
				$benchmarkField->setDecimalPlaces(2);
			} else {
				$benchmarkField->setDecimalPlaces(0);
			}
			
			$entry['benchmarkFieldForUpdate'] = true;
		} else {
			$forUpdate = false;
			
			$fieldName = $column['fieldName'];
			if($benchmarkField->getFieldName() != $fieldName) {
				$benchmarkField->setFieldName($fieldName);
				$forUpdate = true;
			}
			
			$fieldNumber = $column['fieldNumber'];
			if($benchmarkField->getFieldNumber() != $fieldNumber) {
				$benchmarkField->setFieldNumber($fieldNumber);
				$forUpdate = true;
			}
			
			$fieldType = $column['fieldType'];
			if($benchmarkField->getFieldType() != $fieldType) {
				$benchmarkField->setFieldType($fieldType);
				$forUpdate = true;
				
				if($column['fieldType'] == BenchmarkField::DECIMAL_VALUE_TYPE) {
					$benchmarkField->setDecimalPlaces(2);
				} else {
					$benchmarkField->setDecimalPlaces(0);
				}
			}
			
			$showField = $column['showField'];
			if($benchmarkField->getShowField() != $showField) {
				$benchmarkField->setShowField($showField);
				$forUpdate = true;
			}
			
			
			$filterName = $column['filterName'];
			if($benchmarkField->getFilterName() != $filterName) {
				$benchmarkField->setFilterName($filterName);
				$forUpdate = true;
			}
				
			$filterNumber = $column['filterNumber'];
			if($benchmarkField->getFilterNumber() != $filterNumber) {
				$benchmarkField->setFilterNumber($filterNumber);
				$forUpdate = true;
			}
				
			$filterType = $column['filterType'];
			if($benchmarkField->getFilterType() != $filterType) {
				$benchmarkField->setFilterType($filterType);
				$forUpdate = true;
			}
				
			$showFilter = $column['showFilter'];
			if($benchmarkField->getShowFilter() != $showFilter) {
				$benchmarkField->setShowFilter($showFilter);
				$forUpdate = true;
			}
			
			
			$entry['benchmarkFieldForUpdate'] = $forUpdate;
		}
		$entry['benchmarkField'] = $benchmarkField;
	
		$entry['errors'] = $errors;
	
		return $entry;
	}
	
	protected function saveProducts($dataBaseEntries) {
		$errors = array();
	
		$em = $this->doctrine->getManager();
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
		$productRepository = $this->doctrine->getRepository(Product::class);
	
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
		$assignmentRepository = $this->doctrine->getRepository(ProductCategoryAssignment::class);
	
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
			} else if($segment) {
				if($assignment->getSegment() && $assignment->getSegment()->getId() == $segment->getId()) {
					$dataBaseEntry['assignmentForUpdate'] = false;
				} else {
					$assignment->setSegment($segment);
					$dataBaseEntry['assignmentForUpdate'] = true;
				}
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
	
		$em = $this->doctrine->getManager();
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
	
	protected function saveBrands($dataBaseEntries) {
		$errors = array();
	
		$brands = array();
		
		foreach ($dataBaseEntries as $dataBaseEntry) {
			if($dataBaseEntry['brandForUpdate']) {
				$brand = $dataBaseEntry['brand'];
				if(!key_exists($brand->getName(), $brands)) {
					$brands[$brand->getName()] = $brand;
				}
			}
		}
		
		$em = $this->doctrine->getManager();
		$em->getConnection()->beginTransaction();
	
		try {
			foreach ($brands as $brand) {
				$em->persist($brand);
			}
			$em->flush();
			$em->getConnection()->commit();
		} catch (Exception $ex) {
			$em->getConnection()->rollback();
			$errors[] = $ex->getMessage();
		}
	
		return $errors;
	}
	
	protected function saveColumns($dataBaseColumns) {
		$errors = array();
	
		$em = $this->doctrine->getManager();
		$em->getConnection()->beginTransaction();
	
		try {
			foreach ($dataBaseColumns as $dataBaseColumn) {
				$forUpdate = $dataBaseColumn['benchmarkFieldForUpdate'];
	
				if($forUpdate) {
					$benchmarkField = $dataBaseColumn['benchmarkField'];
					$em->persist($benchmarkField);
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
	
	protected function getImage($product, $imageName, $imageType) {
		return StringUtils::getCleanPath($product->getUploadPath()) . '/' . StringUtils::getCleanName($imageName) . '.' . $imageType;
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
	
	protected function getBrandsCounts($dataBaseEntries) {
		$counts = array();
	
		$all = 0;
		$updated = 0;
	
		$brands = array();
		
		foreach ($dataBaseEntries as $dataBaseEntry) {
			$brand = $dataBaseEntry['brand'];
			if(!key_exists($brand->getName(), $brands)) {
				if($dataBaseEntry['brandForUpdate']) {
					$updated++;
				}
				$all++;
				$brands[$brand->getName()] = $brand;
			}
		}
	
		$counts['all'] = $all;
		$counts['updated'] = $updated;
	
		return $counts;
	}
	
	protected function getColumnsCounts($dataBaseColumns) {
		$counts = array();
	
		$all = 0;
		$created = 0;
		$updated = 0;
	
		foreach ($dataBaseColumns as $dataBaseColumn) {
			$all++;
	
			if($dataBaseColumn['benchmarkFieldForUpdate']) {
				$benchmarkField = $dataBaseColumn['benchmarkField'];
				if($benchmarkField->getId() <= 0) $created++;
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
}