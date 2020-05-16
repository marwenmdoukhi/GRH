<?php

namespace App\Controller;

use App\Entity\Conger;
use App\Repository\CongerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepCongerController extends AbstractController
{
    /**
     * @Route("/rep/conger", name="rep_conger")
     */
    public function index(CongerRepository $congerRepository)
    {
        $em=$this->getDoctrine()->getManager();
        $demandenattend=$em->getRepository("App:Conger")->findBy(array('status'=>"0"));
        $demandeaccepter=$em->getRepository("App:Conger")->findBy(array('status'=>"1"));
        $demanderefuser=$em->getRepository("App:Conger")->findBy(array('status'=>"2"));

        return $this->render('rep_conger/index.html.twig',[
            'conge' => $congerRepository->findAll(),
            'demandenattend'=>$demandenattend,
            'demandeaccepter'=>$demandeaccepter,
            'demanderefuser'=>$demanderefuser
        ]);
    }

    /**
     * @Route("/demande/{id}", name="detailconge")
     */
    public function detail($id )
    {
        $em = $this->getDoctrine()->getManager();
        $conge = $em->getRepository('App:Conger')->find($id);

        return $this->render('rep_conger/detail.html.twig',[
            'conge' => $conge

        ]);
    }

    /**
     * @Route("/certif/{id}", name="certif")
     * @param Request $request
     * @return Response
     */
    public function certif(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $certif=$em->find(Conger::class,$id);
        return $this->render('rep_conger/certif.html.twig',[
            'certif' => $certif
        ]);
    }


    /**
     * @Route("/accepter/{id}", name="accepter")
     * @param Request $request
     * @return Response
     */
    public function Accepter(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $conge = $em->getRepository('App:Conger')->find($id);
        $conge->setStatus(1);
        $em->persist($conge);
        $em->flush();
        return  $this->redirectToRoute('detailconge',array('id'=>$conge->getId()));
    }

    /**
     * @Route("/refuser/{id}", name="refuser")
     * @param Request $request
     * @return Response
     */
    public function refuser(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $conge = $em->getRepository('App:Conger')->find($id);
        $conge->setStatus(2);
        $em->persist($conge);
        $em->flush();
        return  $this->redirectToRoute('detailconge',array('id'=>$conge->getId()));
    }




}
