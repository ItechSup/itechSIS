<?php

namespace ItechSup\ItechSisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Event controller.
 * @Method("GET")
 * @Route("/signOffSheet")
 */
class SignOffSheetController extends Controller
{

    /**
     * Lists all Event entities.
     *
     * @Route("/", name="SignOffSheet")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}