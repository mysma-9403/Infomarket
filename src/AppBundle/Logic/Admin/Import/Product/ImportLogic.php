<?php

namespace AppBundle\Logic\Admin\Import\Product;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Entity\Other\ProductScore;
use AppBundle\Entity\Other\ProductValue;
use AppBundle\Entity\Main\Segment;
use AppBundle\Entity\Other\ImportRatings;
use AppBundle\Factory\Admin\ErrorFactory;
use AppBundle\Factory\Admin\Import\Product\ImportErrorFactory;
use AppBundle\Logic\Admin\Import\Common\CountManager;
use AppBundle\Logic\Admin\Import\Common\PersistenceManager;
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

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $productManager;

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $productCategoryAssignmentManager;

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $productValueManager;

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $productScoreManager;

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $productNoteManager;

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $brandManager;

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $benchmarkFieldManager;

	/**
	 *
	 * @var PersistenceManager
	 */
	protected $categorySummaryManager;

	/**
	 *
	 * @var CountManager $countManager
	 */
	protected $countManager;

	public function __construct(Registry $doctrine, ImportErrorFactory $errorFactory, 
			BenchmarkFieldDataBaseUtils $benchmarkFieldDataBaseUtils, PersistenceManager $productManager, 
			PersistenceManager $productCategoryAssignmentManager, PersistenceManager $productValueManager, 
			PersistenceManager $productScoreManager, PersistenceManager $productNoteManager, 
			PersistenceManager $brandManager, PersistenceManager $benchmarkFieldManager, 
			PersistenceManager $categorySummaryManager, CountManager $countManager) {
		$this->doctrine = $doctrine;
		$this->errorFactory = $errorFactory;
		$this->benchmarkFieldDataBaseUtils = $benchmarkFieldDataBaseUtils;
		
		$this->productManager = $productManager;
		$this->productCategoryAssignmentManager = $productCategoryAssignmentManager;
		$this->productValueManager = $productValueManager;
		$this->productScoreManager = $productScoreManager;
		$this->productNoteManager = $productNoteManager;
		$this->brandManager = $brandManager;
		$this->benchmarkFieldManager = $benchmarkFieldManager;
		$this->categorySummaryManager = $categorySummaryManager;
		
		$this->countManager = $countManager;
	}

	/**
	 *
	 * @param ImportRatings $importRatings        	
	 * @param Category $category        	
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
		
		try {
			$mainCategory = $this->getMainCategory($category);
			
			$dataBaseColumns = $this->benchmarkFieldManager->getUpdatedEntries($mainCategory, $columns);
			$benchmarkFieldsCounts = $this->countManager->getCounts($dataBaseColumns, 'benchmarkField');
			$this->benchmarkFieldManager->saveEntries($dataBaseColumns);
			
			$productsCounts = $this->countManager->getCounts($dataBaseEntries, 'product');
			$this->productManager->saveEntries($dataBaseEntries);
			
			$dataBaseEntries = $this->productCategoryAssignmentManager->getUpdatedEntries($category, 
					$dataBaseEntries);
			$assignmentsCounts = $this->countManager->getCounts($dataBaseEntries, 'assignment');
			$this->productCategoryAssignmentManager->saveEntries($dataBaseEntries);
			
			$dataBaseEntries = $this->productValueManager->getUpdatedEntries($category, $dataBaseEntries);
			$productValuesCounts = $this->countManager->getCounts($dataBaseEntries, 'productValue');
			$this->productValueManager->saveEntries($dataBaseEntries);
			
			$dataBaseEntries = $this->productScoreManager->getUpdatedEntries($category, $dataBaseEntries);
			$productScoresCounts = $this->countManager->getCounts($dataBaseEntries, 'productScore');
			$this->productScoreManager->saveEntries($dataBaseEntries);
			
			// TODO refactor - don't do this such hacky way!
			$categorySummaries = [[]];
			$categorySummaries = $this->categorySummaryManager->getUpdatedEntries($mainCategory, 
					$categorySummaries);
			$this->categorySummaryManager->saveEntries($categorySummaries);
			
			$dataBaseEntries = $this->productNoteManager->getUpdatedEntries($category, $dataBaseEntries);
			$productNotesCounts = $this->countManager->getCounts($dataBaseEntries, 'productNote');
			$this->productNoteManager->saveEntries($dataBaseEntries);
			
			$brandsCounts = $this->countManager->getCounts($dataBaseEntries, 'brand');
			$this->brandManager->saveEntries($dataBaseEntries);
		} catch (\Exception $ex) {
			$result['errors'] = [$ex->getMessage()];
			return $result;
		}
		
		$result['errors'] = array();
		$result['lines'] = count($fileEntries);
		$result['brandsCounts'] = $brandsCounts;
		$result['productsCounts'] = $productsCounts;
		$result['assignmentsCounts'] = $assignmentsCounts;
		$result['productNotesCounts'] = $productNotesCounts;
		$result['productScoresCounts'] = $productScoresCounts;
		$result['productValuesCounts'] = $productValuesCounts;
		$result['benchmarkFieldsCounts'] = $benchmarkFieldsCounts;
		
		return $result;
	}

	protected function getMainCategory(Category $category) {
		while (true) {
			$parent = $category->getParent();
			if (! $parent) {
				return null;
			}
			if ($parent->getPreleaf()) {
				return $category;
			}
			$category = $parent;
		}
	}

	protected function getFileEntries($importRatings) {
		$rows = array();
		
		$fileName = urldecode($importRatings->getImportFile());
		
		$file = fopen('../web' . $fileName, 'r');
		
		while (($row = fgetcsv($file, 2048, ';')) !== FALSE) {
			$rows[] = $row;
		}
		
		fclose($file);
		
		return $rows;
	}

	protected function validateCategory($fileEntries, $category) {
		$errors = array();
		
		$columns = $fileEntries[0];
		$importName = trim(trim($columns[0]) . ' ' . trim($columns[1]));
		$categoryName = trim(trim($category->getName()) . ' ' . trim($category->getSubname()));
		if ($importName != $categoryName) {
			dump($importName);
			dump($categoryName);
			$errors[] = $this->errorFactory->createInvalidCategoryError($importName, $categoryName);
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
		
		for ($i = 0; $i < $size; $i ++) {
			$columnName = $columnNames[$i];
			if ($columnName && strlen($columnName) > 0) {
				$item = array();
				
				$item['index'] = $i;
				$item['name'] = $columnName;
				
				$items[$item['name']] = $item;
			} else {
				$fieldTypeName = $fieldTypes[$i];
				if ($fieldTypeName && strlen($fieldTypeName) > 0) {
					
					$fieldType = null;
					
					if ($fieldTypeName == 'decimal') {
						$fieldType = BenchmarkField::DECIMAL_FIELD_TYPE;
					} else if ($fieldTypeName == 'integer') {
						$fieldType = BenchmarkField::INTEGER_FIELD_TYPE;
					} else if ($fieldTypeName == 'boolean' || $fieldTypeName == 'bool') {
						$fieldType = BenchmarkField::BOOLEAN_FIELD_TYPE;
					} else if ($fieldTypeName == 'string') {
						$fieldType = BenchmarkField::STRING_FIELD_TYPE;
					} else if ($fieldTypeName == 'single enum' || $fieldTypeName == 'singleenum') {
						$fieldType = BenchmarkField::SINGLE_ENUM_FIELD_TYPE;
					} else if ($fieldTypeName == 'multi enum' || $fieldTypeName == 'multienum') {
						$fieldType = BenchmarkField::MULTI_ENUM_FIELD_TYPE;
					}
					
					if ($fieldType) {
						$valueNumber = $valueNumbers[$i];
						
						$fieldNumber = $fieldNumbers[$i];
						$fieldName = trim($fieldNames[$i]);
						$showField = $showFields[$i];
						
						$filterName = $fieldName;
						$index = strpos($filterName, '[');
						if ($index !== false) {
							$filterName = trim(substr($filterName, 0, $index));
						}
						$filterNumber = $fieldNumber;
						$showFilter = $showFilters[$i];
						
						$item = array();
						
						// TODO rethink this...
						$field = new BenchmarkField();
						$field->setFieldType($fieldType);
						$field->setValueNumber($valueNumber);
						
						$itemName = $this->benchmarkFieldDataBaseUtils->getValueField($field);
						
						$item['index'] = $i;
						$item['name'] = $itemName;
						
						$item['fieldType'] = $fieldType;
						$item['valueNumber'] = $valueNumber;
						
						$item['fieldName'] = $fieldName;
						$item['fieldNumber'] = $fieldNumber;
						$item['showField'] = $showField;
						
						$item['filterName'] = $filterName;
						$item['filterNumber'] = $filterNumber;
						$item['showFilter'] = $showFilter;
						
						if (key_exists($itemName, $items)) {
							$errors[] = $this->errorFactory->createColumnDuplicateError($itemName, $fieldNumber, 
									$items[$itemName]['fieldNumber']);
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
		
		if (! key_exists('productName', $columns)) {
			$errors[] = $this->errorFactory->createColumnNotExistsError('productName');
		}
		
		if (! key_exists('brandName', $columns)) {
			$errors[] = $this->errorFactory->createColumnNotExistsError('brandName');
		}
		
		foreach ($columns as $column) {
			if (key_exists('valueNumber', $column)) {
				$valueNumber = $column['valueNumber'];
				if ($valueNumber < 1 || $valueNumber > 30) {
					$name = $column['fieldName'];
					$errors[] = $this->errorFactory->createInvalidColumnValueNumberError($name, $valueNumber);
				}
			}
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
			$i ++;
			
			$entry = $this->getPreparedEntry($fileEntry, $i, $columns);
			if ($entry)
				$entries[] = $entry;
		}
		
		return $entries;
	}

	protected function getPreparedEntry($fileEntry, $i, $columns) {
		$entry = array();
		$errors = array();
		
		if (count($fileEntry) <= 0)
			return null;
		
		$productNameIndex = $columns['productName']['index'];
		$productName = $fileEntry[$productNameIndex];
		if (strlen($productName) <= 0) {
			return null;
		}
		
		$brandNameIndex = $columns['brandName']['index'];
		$brandName = $fileEntry[$brandNameIndex];
		if (strlen($brandName) <= 0) {
			$errors[] = $this->errorFactory->createEmptyError($i, 'brand');
		}
		
		$brandWww = null;
		if (key_exists('brandWww', $columns)) {
			$brandWwwIndex = $columns['brandWww']['index'];
			$brandWww = $fileEntry[$brandWwwIndex];
		}
		
		$productPrice = null;
		if (key_exists('productPrice', $columns)) {
			$productPriceIndex = $columns['productPrice']['index'];
			$productPrice = $fileEntry[$productPriceIndex];
			$productPrice = str_replace(",", ".", $productPrice);
		}
		
		$segmentName = null;
		if (key_exists('segmentName', $columns)) {
			$segmentNameIndex = $columns['segmentName']['index'];
			$segmentName = $fileEntry[$segmentNameIndex];
		}
		
		$imageName = strtolower($productName);
		if (key_exists('imageName', $columns)) {
			$imageNameIndex = $columns['imageName']['index'];
			$value = $fileEntry[$imageNameIndex];
			if (strlen($value) > 0)
				$imageName = $value;
		}
		
		$imageType = 'jpg';
		if (key_exists('imageType', $columns)) {
			$imageTypeIndex = $columns['imageType']['index'];
			$value = $fileEntry[$imageTypeIndex];
			if (strlen($value) > 0)
				$imageType = $value;
		}
		
		$featured = false;
		if (key_exists('featured', $columns)) {
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
			if (key_exists('fieldType', $column)) {
				$value = trim($fileEntry[$column['index']]);
				if (strlen($value) < 1) {
					$value = null;
				} else {
					switch ($column['fieldType']) {
						case BenchmarkField::BOOLEAN_FIELD_TYPE:
							if ($value == '-' || $value == '0') {
								$value = 0;
							} else {
								$value = 1;
							}
							break;
						case BenchmarkField::DECIMAL_FIELD_TYPE:
							$value = str_replace(",", ".", $value);
							if ($value == '-' || $value == '') {
								$value = null;
							}
							break;
						default:
							if ($value == '-' || $value == '') {
								$value = null;
							}
							break;
					}
				}
				
				$entry[$column['name']] = $value;
			}
		}
		
		return $entry;
	}

	protected function checkDuplicates($preparedEntries) {
		$count = count($preparedEntries);
		
		for ($i = 0; $i < $count; $i ++) {
			$errors = array();
			$prevEntry = $preparedEntries[$i];
			
			$prevProductName = $prevEntry['productName'];
			$prevBrandName = $prevEntry['brandName'];
			
			for ($j = $i + 1; $j < $count; $j ++) {
				$nextEntry = $preparedEntries[$j];
				
				$nextProductName = $nextEntry['productName'];
				$nextBrandName = $nextEntry['brandName'];
				
				if ($prevProductName == $nextProductName && $prevBrandName == $nextBrandName) {
					
					$prevImageName = $prevEntry['imageName'];
					$nextImageName = $nextEntry['imageName'];
					
					$prevImageType = $prevEntry['imageType'];
					$nextImageType = $nextEntry['imageType'];
					
					if ($prevImageName != $nextImageName || $prevImageType != $nextImageType) {
						$prevNumber = $prevEntry['lineNumber'];
						$nextNumber = $nextEntry['lineNumber'];
						$errors[] = $this->errorFactory->createInconsistentDataError($prevNumber, $nextNumber, 
								$prevBrandName, $prevProductName);
					}
					
					$prevCategoryName = $prevEntry['categoryName'];
					$nextCategoryName = $nextEntry['categoryName'];
					
					if ($prevCategoryName == $nextCategoryName) {
						$prevCategorySubname = $prevEntry['categorySubname'];
						$nextCategorySubname = $nextEntry['categorySubname'];
						
						if ($prevCategorySubname == $nextCategorySubname) {
							$prevNumber = $prevEntry['lineNumber'];
							$nextNumber = $nextEntry['lineNumber'];
							$errors[] = $this->errorFactory->createSameCategoryError($prevNumber, $nextNumber, 
									$prevBrandName, $prevProductName, $prevCategoryName, $prevCategorySubname);
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
			if (! $preparedEntry['duplicate']) {
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
		if (! $brand)
			$errors[] = $this->errorFactory->createNotExistsError($preparedEntry['lineNumber'], 'brand', 
					$brandName);
		else {
			$entry['brand'] = $brand;
			
			$brandWww = $preparedEntry['brandWww'];
			if ($brandWww && strlen($brandWww) > 0 && $brandWww != $brand->getWww()) {
				$brand->setWww($brandWww);
				$entry['brandForUpdate'] = true;
			} else {
				$entry['brandForUpdate'] = false;
			}
		}
		
		$segmentName = $preparedEntry['segmentName'];
		if ($segmentName) {
			$segment = $segmentRepository->findOneBy(['name' => $segmentName]);
			if (! $segment)
				$errors[] = $this->errorFactory->createNotExistsError($preparedEntry['lineNumber'], 'segment', 
						$segmentName);
			else
				$entry['segment'] = $segment;
		} else {
			$entry['segment'] = null;
		}
		
		$entry['category'] = $category;
		
		if ($brand) {
			$productName = $preparedEntry['productName'];
			$imageName = $preparedEntry['imageName'];
			$imageType = $preparedEntry['imageType'];
			
			$productPrice = null;
			if (key_exists('productPrice', $preparedEntry))
				$productPrice = $preparedEntry['productPrice'];
			
			$product = $productRepository->findOneBy(['name' => $productName, 'brand' => $brand]);
			if (! $product) {
				$product = new Product();
				$product->setName($productName);
				
				$product->setInfomarket(false);
				$product->setInfoprodukt(false);
				$product->setBenchmark(true);
				
				$product->setBrand($brand);
				$product->setPrice($productPrice);
				
				$image = $this->getImage($product, $imageName, $imageType);
				
				$product->setImage($image);
				$product->setMimeType('image/' . $imageType);
				
				$entry['productForUpdate'] = ! $preparedEntry['duplicate'];
			} else {
				$image = $this->getImage($product, $imageName, $imageType);
				
				$forUpdate = false;
				if ($product->getImage() != $image) {
					$product->setImage($image);
					$product->setMimeType('image/' . $imageType);
					$forUpdate = true;
				}
				
				if ($productPrice != $product->getPrice()) {
					$product->setPrice($productPrice);
					$forUpdate = true;
				}
				
				if (! $product->getBenchmark()) {
					$product->setBenchmark(true);
					$forUpdate = true;
				}
				
				$entry['productForUpdate'] = $forUpdate;
			}
			$entry['product'] = $product;
			
			$productValue = new ProductValue();
			foreach ($columns as $column) {
				if (key_exists('fieldType', $column)) {
					$columnName = $column['name'];
					$productValue->offsetSet($columnName, $preparedEntry[$columnName]);
				}
			}
			$entry['productValue'] = $productValue;
		}
		
		$entry['featured'] = $preparedEntry['featured'];
		
		$entry['errors'] = $errors;
		
		return $entry;
	}

	protected function getImage($product, $imageName, $imageType) {
		return StringUtils::getCleanPath($product->getUploadPath()) . '/' . StringUtils::getCleanName(
				$imageName) . '.' . $imageType;
	}

	protected function getEntriesErrors($entries) {
		$errors = array();
		
		foreach ($entries as $entry) {
			$entryErrors = $entry['errors'];
			if (count($entryErrors) > 0) {
				$errors = array_merge($errors, $entryErrors);
			}
		}
		
		return $errors;
	}
}