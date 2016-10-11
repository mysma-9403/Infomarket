<?php

namespace AppBundle\Manager\Params\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\LinkFilter;
use AppBundle\Entity\Filter\PageFilter;
use AppBundle\Entity\Link;
use AppBundle\Entity\Page;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class FooterParamsManager extends ParamsManager {
	
	public function getParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
		
		
		$userRepository = $this->doctrine->getRepository(User::class); //TODO bedzie usuniete
    	
		
    	$pageFilter = new PageFilter($userRepository);
    	$pageFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$pageFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$pageFilter->setOrderBy('e.orderNumber ASC');
    	
    	$pages = $this->getParamList(Page::class, $pageFilter);
    	$viewParams['menuPages'] = $pages;
    	
    	 
    	$linkFilter = new LinkFilter($userRepository);
    	$linkFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$linkFilter->setTypes([Link::FOOTER_LINK]);
    	$linkFilter->setOrderBy('e.orderNumber ASC');
    	
    	$links = $this->getParamList(Link::class, $linkFilter);
    	$viewParams['menuLinks'] = $links;
    	
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}