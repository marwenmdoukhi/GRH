<?php

namespace App\Controller;

use App\Entity\Conger;
use App\Form\DemandeCongerType;
use Gedmo\Sluggable\Util\Urlizer;
use MedicalBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DemandeCongerController extends AbstractController
{
    /**
     * @Route("/conger/demande", name="demande_conger")
     */
    public function new(Request $request)
    {
        $conger= new Conger();
        $user=$this->getUser();
        $form=$this->createForm('App\Form\DemandeCongerType',$conger);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form['fichier']->getData();
            if ($uploadedFile){

                $destination = $this->getParameter('brochures_directory') ;
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $conger->setFichier($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $conger->setDemandeur($user);
            $conger->setStatus("0");
            $conger->setRepundu("0");

            $em->persist($conger);
            $em->flush();

            return $this->redirectToRoute('indexconger');
        }

        return $this->render('demande_conger/new.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/conger/index", name="indexconger")
     */
    public function index(Request $request){
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            ' SELECT c
                FROM  App\Entity\Conger c
                 where c.demandeur =:uc 
         
                  ');
        $query->SetParameters(array('uc' => $user->getID()));
        $mesdemande = $query->getResult();

        return $this->render('demande_conger/index.html.twig', [
            'mesdemande'=>$mesdemande

        ]);

    }


    /**
     * @Route("/conger/{id}/editconger", name="editdemandeconger", methods={"GET","POST"})
     * @param Request $request
     * @param $id
     */
    public function edit(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository('App:Conger')->find($id);
        $form = $this->createForm(DemandeCongerType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('indexconger');
        }

        return $this->render('demande_conger/edit.html.twig', [
            'demande' => $demande,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/conger/delete/{id}", name="deleteconger")
     */
    public function delete(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $conger = $em->getRepository('App:Conger')->find($id);

        $image=$conger->getFichier();
        $image_path = $this->getParameter('brochures_directory') .'/'. $image;
        if (file_exists($image_path))
            unlink($image_path);
        $em = $this->getDoctrine()->getManager();
        $em->remove($conger);
        $em->flush();

        return $this->redirectToRoute('indexconger');
    }

}
