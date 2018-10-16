<?php

namespace Nam\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("/nam/product/create")
     */
    public function CreateAction()
    {
        return $this->render('NamBundle:Product:create.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/nam/product/update")
     */
    public function UpdateAction()
    {
        return $this->render('NamBundle:Product:update.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/nam/product")
     */
    public function IndexAction()
    {
        return $this->render('NamBundle:Product:index.html.twig', array(
            // ...
        ));
    }

}
