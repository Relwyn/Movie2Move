<?php

namespace THAG\M2MBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('THAGM2MBundle:Default:index.html.twig');
    }
}
