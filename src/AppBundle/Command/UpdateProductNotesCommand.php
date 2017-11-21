<?php

namespace AppBundle\Command;

use AppBundle\Entity\Main\Product;
use AppBundle\Logic\Common\Product\ItemsCreator\ProductItemsCreator;
use AppBundle\Logic\Common\Product\ItemsUpdater\ProductItemsUpdater;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\LockHandler;

class UpdateProductNotesCommand extends Command {

	/**
	 *
	 * @var ProductItemsCreator
	 */
	protected $productItemsCreator;

	/**
	 *
	 * @var ProductItemsUpdater
	 */
	protected $productItemsUpdater;

	public function __construct(ProductItemsCreator $productItemsCreator, 
			ProductItemsUpdater $productItemsUpdater) {
		parent::__construct();
		
		$this->productItemsCreator = $productItemsCreator;
		$this->productItemsUpdater = $productItemsUpdater;
	}

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
		
		$created = $this->productItemsCreator->createMissingItems();
		$updated = $this->productItemsUpdater->updateProductItems($start);
		
		$processingTime = $this->getProcessingTime($start);
		$this->logMessage($output, 'Products notes updated in: ' . $processingTime->format('i:s') . '.');
		
		$this->logSummary($output, $created, $updated);
		
		$lockHandler->release();
	}

	protected function logSummary(OutputInterface $output, $created, $updated) {
		$logged = false;
		
		$logged |= $this->logCounts($output, $created, 'productValues', 'Product values created');
		
		$logged |= $this->logCounts($output, $created, 'productScores', 'Product scores created');
		$logged |= $this->logCounts($output, $updated, 'productScores', 'Product scores updated');
		
		$logged |= $this->logCounts($output, $created, 'productNotes', 'Product notes created');
		$logged |= $this->logCounts($output, $updated, 'productNotes', 'Product notes updated');
		
		$logged |= $this->logCounts($output, $created, 'categoryDistributions', 'Category distributions created');
		$logged |= $this->logCounts($output, $updated, 'categoryDistributions', 'Category distributions updated');
		
		$logged |= $this->logCounts($output, $created, 'categorySummaries', 'Category summaries created');
		$logged |= $this->logCounts($output, $updated, 'categorySummaries', 'Category summaries updated');
		
		if (! $logged) {
			$this->logMessage($output, 'Nothing to process.'); // TODO translator
		}
	}

	/**
	 *
	 * @param OutputInterface $output        	
	 * @param unknown $counts        	
	 * @param unknown $countNames        	
	 * @param unknown $updateType        	
	 *
	 * @return <code>true</code> when message was logged
	 */
	private function logCounts(OutputInterface $output, $counts, $type, $message) {
		$total = $counts[$type]['total'];
		
		if ($total > 0) {
			$done = $counts[$type]['done'];
			// TODO translator
			$this->logMessage($output, $message . ': ' . $done . " / " . $total);
			return true;
		}
		return false;
	}

	private function logMessage(OutputInterface $output, $message) {
		$date = new \DateTime();
		$output->writeln($date->format('Y-m-d H:i:s: ') . $message);
	}

	private function getProcessingTime(\DateTime $start) {
		$end = new \DateTime();
		$interval = date_diff($start, $end);
		
		$processingTime = new \DateTime('0000-01-01');
		$processingTime->add($interval);
		
		return $processingTime;
	}

	public static function exception_error_handler($severity, $message, $file, $line) {
		if (! (error_reporting() & $severity)) {
			return;
		}
		throw new \ErrorException($message, 0, $severity, $file, $line);
	}
}
