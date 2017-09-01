<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkFieldManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var BenchmarkField $entry */
		
		$entry->setCategory($request->get('category'));
		
		$entry->setDecimalPlaces(2);
		
		return $entry;
	}

	/**
	 *
	 * @param BenchmarkField $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var BenchmarkField $entry */
		
		$entry->setCategory($template->getCategory());
		
		$entry->setFieldType($template->getFieldType());
		$entry->setValueNumber($template->getValueNumber());
		
		$entry->setFieldName($template->getFieldName());
		$entry->setFieldNumber($template->getFieldNumber());
		$entry->setShowField($template->getShowField());
		
		$entry->setFilterName($template->getFilterName());
		$entry->setFilterNumber($template->getFilterNumber());
		$entry->setShowFilter($template->getShowFilter());
		
		$entry->setDecimalPlaces($template->getDecimalPlaces());
		
		return $entry;
	}

	protected function getEntityType() {
		return BenchmarkField::class;
	}
}