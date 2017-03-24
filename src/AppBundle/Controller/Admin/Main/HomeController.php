<?php

namespace AppBundle\Controller\Admin\Main;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
    	$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
    	
    	$viewParams = array();
    	$viewParams['isAdmin'] = $this->isAdmin();
    	
        return $this->render($this->getIndexView(), $viewParams);
    }
    
    //---------------------------------------------------------------------------
    // Permissions
    //---------------------------------------------------------------------------
    protected function isAdmin() {
    	return $this->isGranted('ROLE_ADMIN');
    }
    
    //---------------------------------------------------------------------------
    // Roles
    //---------------------------------------------------------------------------
    protected function getShowRole() {
    	return 'ROLE_USER';
    }
    
    //---------------------------------------------------------------------------
    // Views
    //---------------------------------------------------------------------------
    protected function getIndexView()
    {
    	return $this->getDomain() . '/admin/index.html.twig';
    }
    
    protected function getDomain()
    {
    	return 'admin';
    }
}
