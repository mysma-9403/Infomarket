<?php

namespace AppBundle\Controller\Infoprodukt;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SiteController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('infoprodukt/index.html.twig');
    }
}
