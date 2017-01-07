<?php

namespace AppBundle\Manager\Params\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\LinkFilter;
use AppBundle\Entity\Filter\PageFilter;
use AppBundle\Entity\Link;
use AppBundle\Entity\Page;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Params\Base\ParamsManager;

class FooterParamsManager extends ParamsManager {
	
	protected $infomarket;
	protected $infoprodukt;
	
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		
		$this->infomarket = false;
		$this->infoprodukt = false;
	}
	
	public function getParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
		
		
		$userRepository = $this->doctrine->getRepository(User::class); //TODO bedzie usuniete
    	
		
    	$pageFilter = new PageFilter($userRepository);
    	if($this->infomarket) $pageFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
    	if($this->infoprodukt) $pageFilter->setInfoprodukt(BaseEntityFilter::TRUE_VALUES);
    	$pageFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$pageFilter->setOrderBy('e.orderNumber ASC');
    	
    	$pages = $this->getParamList(Page::class, $pageFilter);
    	$viewParams['menuPages'] = $pages;
    	
    	 
    	$linkFilter = new LinkFilter($userRepository);
    	if($this->infomarket) $linkFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
    	if($this->infoprodukt) $linkFilter->setInfoprodukt(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setTypes([Link::FOOTER_LINK]);
    	$linkFilter->setOrderBy('e.orderNumber ASC');
    	
    	$links = $this->getParamList(Link::class, $linkFilter);
    	$viewParams['menuLinks'] = $links;
    	
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}