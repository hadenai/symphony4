<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default_index")
     */
    public function index()
    {
        return $this->render('blog/default.html.twig', [

        ]);
    }
}