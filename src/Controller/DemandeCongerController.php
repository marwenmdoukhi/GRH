<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DemandeCongerController extends AbstractController
{
    /**
     * @Route("/demande/conger", name="demande_conger")
     */
    public function index()
    {
        return $this->render('demande_conger/index.html.twig', [
            'controller_name' => 'DemandeCongerController',
        ]);
    }
}
