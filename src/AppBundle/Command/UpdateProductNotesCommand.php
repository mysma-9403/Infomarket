<?php

namespace AppBundle\Command;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductNote;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Logic\Benchmark\Fields\BenchmarkFieldLogic;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use AppBundle\Repository\Admin\Main\ProductNoteRepository;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\LockHandler;
use Symfony\Component\HttpFoundation\Request;

class UpdateProductNotesCommand extends ContainerAwareCommand
{
	protected $container;
	protected $doctrine;
	protected $em;
	
	/** @var CategoryRepository $categoryRepository */
	protected $categoryRepository;
	
	/** @var BenchmarkFieldRepository $benchmarkFieldRepository */
	protected $benchmarkFieldRepository;
	
	/** @var ProductRepository $productRepository */
	protected $productRepository;
	
	/** @var ProductNoteRepository $productNoteRepository */
	protected $productNoteRepository;
	
	protected function configure()
	{
		$this
		->setName('krk:product:note:update')
		->setDescription('Update products notes.')
		->setHelp('Update products notes.')
		;
	}
	
	protected function execute(InputInterface $input, OutputInterface $output)
	{	
		$lockHandler = new LockHandler('product.lock');
		if (!$lockHandler->lock()) {
			return 0;
		}
		
		set_error_handler(self::class . '::exception_error_handler');
		
		$start = new \DateTime();
		
		$this->init();
		$this->updateNotes();
				
		$end = new \DateTime();
				
		$interval = date_diff($start, $end);
		$processingTime = new \DateTime('0000-01-01');
		$processingTime->add($interval);
		
		$this->logMessage($output, 'Products notes updated in: ' . $processingTime->format('i:s') . '.');
		
		$lockHandler->release();
	}
	
	protected function init() {
		$this->container = $this->getContainer();
		$this->doctrine = $this->container->get('doctrine');
		$this->em = $this->doctrine->getManager();
		
		$this->categoryRepository = $this->doctrine->getRepository(Category::class);
		$this->benchmarkFieldRepository = new BenchmarkFieldRepository($this->em, $this->em->getClassMetadata(BenchmarkField::class));
		$this->productRepository = new ProductRepository($this->em, $this->em->getClassMetadata(Product::class));
		$this->productNoteRepository = new ProductNoteRepository($this->em, $this->em->getClassMetadata(ProductNote::class));
	}
	
	protected function updateNotes() {
		$categories = $this->getBenchmarkCategories();
		
		foreach ($categories as $category) {
			$this->updateCategoryNotes($category['id']);
		}
	}
	
	protected function getBenchmarkCategories() {
		return $this->categoryRepository->findBenchmarkItems();
	}
	
	protected function updateCategoryNotes($categoryId) {
		$fields = $this->getBenchmarkFields($categoryId);
		$products = $this->getBenchmarkProducts($categoryId);
		
		foreach ($products as $product) {
			$this->updateProductNotes($product, $fields);
		}
	}
	
	protected function getBenchmarkFields($categoryId) {
		$fields = $this->benchmarkFieldRepository->findItemsByCategory($categoryId);
		
		$logic = new BenchmarkFieldLogic($this->productRepository, $categoryId);

		for($i = 0; $i < count($fields); $i++) {
			$field = $fields[$i];
			
			$field = $logic->initNoteFieldProperties($field);
			
			$fields[$i] = $field;
		}
		
		return $fields;
	}
	
	protected function getBenchmarkProducts($categoryId) {
		$filter = new ProductFilter($this->benchmarkFieldRepository);
		$filter->initContextParams(['subcategory' => $categoryId]);
		$filter->initRequestValues(new Request());
		return $this->productRepository->findItems($filter);
	}
	
	protected function updateProductNotes($product, $fields) {
		$productNote = $this->getProductNote($product['id']);
		
		$overalNote = 0.;
		$overalCount = 0.;
		
		foreach ($fields as $field) {
			$valueField = $field['valueField'];
			$valueType = $field['valueType'];
			$noteField = $field['noteField'];
			$noteType = $field['noteType'];
			$noteWeight = $field['noteWeight'];
			
			if($noteType != BenchmarkField::NONE_NOTE_TYPE) {
				$value = $product[$valueField];
				$note = 5.;
				
				switch($valueType) {
					case BenchmarkField::DECIMAL_FIELD_TYPE:
					case BenchmarkField::INTEGER_FIELD_TYPE:
					case BenchmarkField::BOOLEAN_FIELD_TYPE:
						$min = $field['min'];
						$max = $field['max'];
						
						if($min && $max && $max > $min) {
							if($value) {
								if($noteType == BenchmarkField::ASC_NOTE_TYPE) {
									$note = 2. + 3. * ($value - $min) / ($max - $min);
								} else {
									$note = 5. - 3. * ($value - $min) / ($max - $min);
								}
							} else {
								$note = 2.;
							}
						}
						break;
					case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
					case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
						if($value && $noteType == BenchmarkField::ENUM_NOTE_TYPE) {
							$enums = $field['enums'];
							
							$max = 0;
							foreach($enums as $enum) {
								$value = $enum['value'];
								if($max < $value) {
									$max = $value;
								}
							}
							$value = $productRepository->findEnumValue($product['id'], $valueField);
							
							$note = 2. + 3. * $value / $max;
						} //TODO refactor if else logic!!
				}
				$productNote->offsetSet($noteField, $note); 
				
				//TODO factory
				if($note > 5) dump("Error: Invalid note (" . $note . ") for field '" . $field['fieldName'] . "' in product: " . $product['id'] . ". Values: min=" . 
						$min . ", max=" . $max . ", value=" . $value . ".");
				
				$overalNote += $note * $noteWeight;
				$overalCount += $noteWeight;
			}
		}
		   
		if($overalCount > 0) {
			$overalNote /= $overalCount;
			$productNote->setOveralNote($overalNote);
			
			//TODO factory
			if($overalNote > 5) dump("Error: Invalid overal note (" . $overalNote . ") for field '" . $field['fieldName'] . "' in product: " . $product['id'] . ".");
		}
		
		$this->em->persist($productNote);
		$this->em->flush();
	}
	
	protected function getProductNote($productId) {
		$productNote = $this->productNoteRepository->findOneBy(['product' => $productId]);
		if(!$productNote) {
			$productNote = new ProductNote();
			$productNote->setProduct($this->productRepository->find($productId));
		}
		return $productNote;
	}
	
	
	
	
	protected function logMessage(OutputInterface $output, $message) {
		$date = new \DateTime();
		$output->writeln($date->format('Y-m-d H:i:s: ') . $message);
	}
	
	public static function exception_error_handler($severity, $message, $file, $line) {
		if (!(error_reporting() & $severity)) {
			return;
		}
		throw new \ErrorException($message, 0, $severity, $file, $line);
	}
}
