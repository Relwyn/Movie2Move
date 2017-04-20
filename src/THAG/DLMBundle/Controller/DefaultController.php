<?php

namespace THAG\DLMBundle\Controller;

use Buzz\Message\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('THAGDLMBundle:Default:index.html.twig');
    }

    public function jeuAction(){
        return $this->render('THAGDLMBundle:Default:jeu.html.twig');
    }
}
