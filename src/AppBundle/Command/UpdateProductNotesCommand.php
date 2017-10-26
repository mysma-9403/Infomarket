<?php

namespace AppBundle\Command;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializerImpl;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Repository\Admin\Assignments\ProductCategoryAssignmentRepository;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use AppBundle\Repository\Admin\Other\CategorySummaryRepository;
use AppBundle\Repository\Admin\Other\ProductNoteRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\LockHandler;
use AppBundle\Repository\Admin\Other\ProductValueRepository;
use AppBundle\Repository\Admin\Other\ProductScoreRepository;

class UpdateProductNotesCommand extends ContainerAwareCommand {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 *
	 * @var CategorySummaryRepository
	 */
	protected $categorySummaryRepository;

	/**
	 *
	 * @var ProductRepository
	 */
	protected $productRepository;

	/**
	 *
	 * @var ProductCategoryAssignmentRepository
	 */
	protected $productCategoryAssignmentRepository;

	/**
	 *
	 * @var ProductNoteRepository
	 */
	protected $productNoteRepository;

	/**
	 *
	 * @var BenchmarkFieldsProvider
	 */
	protected $benchmarkFieldsProvider;

	/**
	 *
	 * @var BenchmarkFieldsInitializer
	 */
	protected $showFieldsInitializer;

	/**
	 *
	 * @var BenchmarkFieldDataBaseUtils
	 */
	protected $benchmarkFieldsDataBaseUtils;

	protected function configure() {
		$this->setName('krk:product:notes:update')->setDescription('Update product notes.')->setHelp(
				'Update product notes');
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$lockHandler = new LockHandler('product.note.lock');
		if (! $lockHandler->lock()) {
			return 0;
		}
		
		set_error_handler(self::class . '::exception_error_handler');
		
		$start = new \DateTime();
		
		$this->init();
		
		$summaries = [];
		$summaries['created'] = $this->createSummaries($start);
		$summaries['updated'] = $this->updateSummaries($start);
		
		$notes = [];
		$notes['created'] = $this->createProductNotes($start);
		$notes['updated'] = $this->updateProductNotes($start);
		
		$end = new \DateTime();
		
		$interval = date_diff($start, $end);
		
		$processingTime = new \DateTime('0000-01-01');
		$processingTime->add($interval);
		
		$this->logMessage($output, 'Products notes updated in: ' . $processingTime->format('i:s') . '.');
		
		$this->logSummary($output, $summaries, $notes);
		
		$lockHandler->release();
	}

	protected function init() {
		$container = $this->getContainer();
		$doctrine = $container->get('doctrine');
		$this->em = $doctrine->getManager();
		
		$this->categoryRepository = $container->get(CategoryRepository::class);
		$this->categorySummaryRepository = $container->get(CategorySummaryRepository::class);
		
		$this->productRepository = $container->get(ProductRepository::class);
		$this->productCategoryAssignmentRepository = $container->get(ProductCategoryAssignmentRepository::class);
		
		$this->productValueRepository = $container->get(ProductValueRepository::class);
		$this->productScoreRepository = $container->get(ProductScoreRepository::class);
		$this->productNoteRepository = $container->get(ProductNoteRepository::class);
		
		$this->benchmarkFieldsProvider = $container->get(BenchmarkFieldsProvider::class);
		$this->showFieldsInitializer = $container->get(BenchmarkFieldsInitializerImpl::class);
		$this->benchmarkFieldsDataBaseUtils = $container->get(BenchmarkFieldDataBaseUtils::class);
	}

	protected function createSummaries($start) {
		$categories = $this->categoryRepository->findItemsWithoutSummary();
		
		$total = count($categories);
		$done = 0;
		
		if ($total > 0) {
			$this->categorySummaryRepository->createItems($categories);
			$done = $total;
		}
		
		return ['total' => $total, 'done' => $done];
	}

	protected function updateSummaries($start) {
		$summaries = $this->categorySummaryRepository->findBy(['upToDate' => false]);
		
		$total = count($summaries);
		$done = 0;
		
		foreach ($summaries as $summary) {
			$this->updateSummary($summary);
			$done ++;
			
			if($done % 100 == 0) {
				$this->em->flush();
			}
			
			$end = new \DateTime();
			
			$commandInterval = $end->getTimestamp() - $start->getTimestamp();
			
			if ($commandInterval > 280) {
				break;
			}
		}
		
		$this->em->flush();
		return ['total' => $total, 'done' => $done];
	}

	protected function updateSummary(CategorySummary $summary) {
		$minMaxValues = $this->productRepository->findAllMinMaxValues($summary->getCategory()->getId());
		
		$summary = $this->updateMinMaxValues($summary, $minMaxValues);
		$summary->setUpToDate(true);
		
		$this->em->persist($summary);
	}

	protected function updateMinMaxValues(CategorySummary $summary, $minMaxValues) {
		foreach ($minMaxValues as $key => $value) {
			$summary->offsetSet($key, $value);
		}
		return $summary;
	}

	protected function createProductNotes($start) {
		$productCategoryAssignments = $this->productCategoryAssignmentRepository->findItemsWithoutProductNote();
		
		$total = count($productCategoryAssignments);
		$done = 0;
		
		if ($total > 0) {
			$this->productValueRepository->createItems($productCategoryAssignments);
			$this->productScoreRepository->createItems($productCategoryAssignments);
			$this->productNoteRepository->createItems($productCategoryAssignments);
			$done = $total;
		}
		
		return ['total' => $total, 'done' => $done];
	}

	protected function updateProductNotes($start) {
		$productNotes = $this->productNoteRepository->findBy(['upToDate' => false]);
		
		$total = count($productNotes);
		$done = 0;
		
		$productCategories = $this->groupProductNotes($productNotes);
		$done += $this->updateProductCategories($start, $productCategories);
		
		return ['total' => $total, 'done' => $done];
	}

	protected function groupProductNotes($productNotes) {
		$result = [];
		
		/** @var ProductNote $productNote */
		foreach ($productNotes as $productNote) {
			$key = $productNote->getProductCategoryAssignment()->getCategory()->getId();
			if (key_exists($key, $result)) {
				$result[$key][] = $productNote;
			} else {
				$result[$key] = [$productNote];
			}
		}
		
		return $result;
	}

	protected function updateProductCategories($start, $productCategories) {
		$done = 0;
		
		foreach ($productCategories as $categoryId => $productNotes) {
			$done += $this->updateProductCategory($start, $categoryId, $productNotes);
		}
		
		return $done;
	}

	protected function updateProductCategory($start, $categoryId, $productNotes) {
		$done = 0;
		
		$summary = $this->categorySummaryRepository->findOneBy(['category' => $categoryId]);
		$fields = $this->getBenchmarkFields($categoryId);
		
		foreach ($productNotes as $productNote) {
			//TODO updateProductScore
			$this->updateProductNote($productNote, $summary, $fields);
			$done ++;
			
			if($done % 100 == 0) {
				$this->em->flush();
			}
			
			$end = new \DateTime();
			
			$commandInterval = $end->getTimestamp() - $start->getTimestamp();
			
			if ($commandInterval > 280) {
				break;
			}
		}
		
		$this->em->flush();
		return $done;
	}

	protected function updateProductNote(ProductNote $productNote, CategorySummary $summary, $fields) {
		$productId = $productNote->getProductCategoryAssignment()->getProduct()->getId();
		$product = $this->productRepository->find($productId);
		$overal = ['note' => 0., 'weight' => 0.];
		
		for ($i = 1; $i <= 30; $i ++) {
			$this->updateFieldNote($productNote, $overal, $product, $summary, $fields, 
					BenchmarkField::DECIMAL_FIELD_TYPE, $i);
			
			$this->updateFieldNote($productNote, $overal, $product, $summary, $fields, 
					BenchmarkField::INTEGER_FIELD_TYPE, $i);
			
			$this->updateFieldNote($productNote, $overal, $product, $summary, $fields, 
					BenchmarkField::BOOLEAN_FIELD_TYPE, $i);
			
			$this->updateFieldNote($productNote, $overal, $product, $summary, $fields, 
					BenchmarkField::SINGLE_ENUM_FIELD_TYPE, $i);
			
			$this->updateFieldNote($productNote, $overal, $product, $summary, $fields, 
					BenchmarkField::MULTI_ENUM_FIELD_TYPE, $i);
		}
		
		$overalNote = $overal['note'];
		$overalWeight = $overal['weight'];
		
		$productNote->setOveralNote($overalWeight > 0 ? $overalNote / $overalWeight : 0.);
		$productNote->setUpToDate(true);
		
		$this->em->persist($productNote);
	}

	protected function updateFieldNote(ProductNote &$productNote, &$overal, Product $product, 
			CategorySummary $summary, $fields, $fieldType, $num) {
		$noteEntry = $this->getFieldNoteEntry($product, $summary, $fields, $fieldType, $num);
		
		$note = $noteEntry['note'];
		$noteWeight = $noteEntry['noteWeight'];
		
		$noteField = $this->benchmarkFieldsDataBaseUtils->getNoteFieldProperty($fieldType, $num);
		$productNote->offsetSet($noteField, $note);
		
		$overal['note'] = $overal['note'] + $note * $noteWeight;
		$overal['weight'] = $overal['weight'] + $noteWeight;
	}

	protected function getFieldNoteEntry(Product $product, CategorySummary $summary, $fields, $fieldType, $num) {
		$valueField = $this->benchmarkFieldsDataBaseUtils->getValueFieldProperty($fieldType, $num);
		$minField = $this->benchmarkFieldsDataBaseUtils->getMinFieldProperty($fieldType, $num);
		$maxField = $this->benchmarkFieldsDataBaseUtils->getMaxFieldProperty($fieldType, $num);
		
		$value = $product->offsetGet($valueField);
		$min = $summary->offsetGet($minField);
		$max = $summary->offsetGet($maxField);
		
		$note = 0;
		$noteWeight = 0;
		
		$field = $this->getBenchmarkField($fields, $fieldType, $num);
		if ($field) {
			$noteWeight = $field['noteWeight'];
			$noteType = $field['noteType'];
			
			$note = $this->getFieldNote($value, $min, $max, $noteType);
		}
		
		return ['note' => $note, 'noteWeight' => $noteWeight];
	}

	protected function getBenchmarkField($fields, $fieldType, $num) {
		foreach ($fields as $field) {
			if ($field['fieldType'] == $fieldType && $field['valueNumber'] == $num) {
				return $field;
			}
		}
		return null;
	}

	protected function getFieldNote($value, $min, $max, $noteType) {
		if ($value && $max && $max > $min) {
			if ($noteType == BenchmarkField::ASC_NOTE_TYPE) {
				return 2. + 3. * ($value - $min) / ($max - $min);
			} else {
				return 5. - 3. * ($value - $min) / ($max - $min);
			}
		}
		return 0.;
	}

	protected function getBenchmarkFields($categoryId) {
		$fields = $this->benchmarkFieldsProvider->getAllFields($categoryId);
		$fields = $this->showFieldsInitializer->init($fields, $categoryId);
		
		return $fields;
	}

	protected function logSummary(OutputInterface $output, $summaries, $notes) {
		$nothingProcessed = true;
		
		
		$summariesCreatedTotal = $summaries['created']['total'];
		$summariesUpdatedTotal = $summaries['updated']['total'];
		
		if ($summariesCreatedTotal > 0) {
			$createdDone = $summaries['created']['done'];
			$this->logMessage($output, 
					'Category summaries created: ' . $createdDone . " / " . $summariesCreatedTotal);
			$nothingProcessed = false;
		}
		if ($summariesUpdatedTotal > 0) {
			$updatedDone = $summaries['updated']['done'];
			$this->logMessage($output, 
					'Category summaries updated: ' . $updatedDone . " / " . $summariesUpdatedTotal);
			$nothingProcessed = false;
		}
		
		
		$notesCreatedTotal = $notes['created']['total'];
		$notesUpdatedTotal = $notes['updated']['total'];
		
		if ($notesCreatedTotal > 0) {
			$createdDone = $notes['created']['done'];
			$this->logMessage($output, 'Product notes created: ' . $createdDone . " / " . $notesCreatedTotal);
			$nothingProcessed = false;
		}
		if ($notesUpdatedTotal > 0) {
			$updatedDone = $notes['updated']['done'];
			$this->logMessage($output, 'Product notes updated: ' . $updatedDone . " / " . $notesUpdatedTotal);
			$nothingProcessed = false;
		}
		if ($nothingProcessed) {
			$this->logMessage($output, 'Nothing to process.');
		}
	}

	protected function logMessage(OutputInterface $output, $message) {
		$date = new \DateTime();
		$output->writeln($date->format('Y-m-d H:i:s: ') . $message);
	}

	public static function exception_error_handler($severity, $message, $file, $line) {
		if (! (error_reporting() & $severity)) {
			return;
		}
		throw new \ErrorException($message, 0, $severity, $file, $line);
	}
}
