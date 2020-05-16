<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RepCongerController extends AbstractController
{
    /**
     * @Route("/rep/conger", name="rep_conger")
     */
    public function index()
    {
        return $this->render('rep_conger/index.html.twig', [
            'controller_name' => 'RepCongerController',
        ]);
    }
}
