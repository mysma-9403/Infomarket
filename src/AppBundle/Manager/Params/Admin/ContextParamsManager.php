<?php

namespace AppBundle\Manager\Params\Admin;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Admin\Main\BenchmarkMessageRepository;
use Symfony\Component\HttpFoundation\Request;

class ContextParamsManager extends ParamsManager {
	
	/**
	 * 
	 * @var array
	 */
	protected $lastRouteParams;
	
	/**
	 *
	 * @var BenchmarkMessageRepository
	 */
	protected $benchmarkMessageRepository;
	
	public function __construct($doctrine, array $lastRouteParams) {
		parent::__construct($doctrine, null);
		
		$this->lastRouteParams = $lastRouteParams;
		
		$em = $this->doctrine->getManager();
		
		$this->benchmarkMessageRepository = new BenchmarkMessageRepository($em, $em->getClassMetadata(BenchmarkMessage::class));
	}
	
	public function getParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
		
		$unreadMessagesCount = $this->getUnreadMessagesCount();
		$viewParams['unreadMessagesCount'] = $unreadMessagesCount;
		
    	$params['viewParams'] = $viewParams;
    	
    	return $params;
	}
	
	
	protected function getUnreadMessagesCount() {
		return $this->benchmarkMessageRepository->findUnreadItemsCount();
	}
}