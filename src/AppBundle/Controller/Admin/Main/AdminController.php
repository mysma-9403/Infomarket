<?php

namespace AppBundle\Controller\Admin\Main;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction(Request $request)
    {
    	$this->denyAccessUnlessGranted($this->getShowRole(), null, 'Unable to access this page!');
    	
        return $this->render('admin/admin/index.html.twig');
    }
    
    protected function getShowRole() {
    	return 'ROLE_USER';
    }
}
