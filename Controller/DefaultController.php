<?php

namespace Aldaflux\SwissArmyKnifeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



/**
 * @Route("/swissarmyknife")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AldafluxSwissArmyKnifeBundle:Default:index.html.twig');
    }
    
    
    /**
     * @Route("/sak.js", name="aldaflux_swiss_army_knife_javascrtipt")
     */
    public function JavaScriptAction()
    {
       
        return $this->render('AldafluxSwissArmyKnifeBundle:Default:sak.js.twig' );
//        return $this->render('AldafluxDataTableSimpleBundle:index.html.twig');
    }
    
    
    
    
}
