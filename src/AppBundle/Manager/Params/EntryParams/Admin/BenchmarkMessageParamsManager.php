<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkMessageParamsManager extends EntryParamsManager {

	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		$viewParams = $params['viewParams'];
		/** @var BenchmarkMessage $entry */
		$entry = $viewParams['entry'];
		$entry->setReadByAdmin(true);
		
		$newParams = parent::getNewParams($request, $params);
		/** @var BenchmarkMessage $newEntry */
		$newEntry = $newParams['viewParams']['entry'];
		
		$newEntry->setParent($entry);
		$newEntry->setProduct($entry->getProduct());
		$newEntry->setReadByAdmin(true);
		$newEntry->setReadByAuthor(false);
		
		$viewParams['entry'] = $entry;
		$viewParams['newEntry'] = $newEntry;
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}
}