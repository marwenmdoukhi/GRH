<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pays")
 */
class PaysController extends AbstractController
{
    /**
     * @Route("/", name="pays_index", methods={"GET"})
     * @param PaysRepository $paysRepository
     * @return Response
     */
    public function index(PaysRepository $paysRepository): Response
    {
        return $this->render('pays/index.html.twig', [
            'pays' => $paysRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pays_new", methods={"GET","POST"})
     *      *     * @Security("has_role('ROLE_SUPER_ADMIN')")

     */
    public function new(Request $request): Response
    {
        $pay = new Pays();
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pay);
            $entityManager->flush();

            return $this->redirectToRoute('pays_index');
        }

        return $this->render('pays/new.html.twig', [
            'pay' => $pay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pays_show", methods={"GET"})
     */
    public function show($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pay = $em->getRepository('App:Pays')->find($id);
        return $this->render('pays/show.html.twig', [
            'pay' => $pay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pays_edit", methods={"GET","POST"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function edit(Request $request,$id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pay = $em->getRepository('App:Pays')->find($id);
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pays_index');
        }

        return $this->render('pays/edit.html.twig', [
            'pay' => $pay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pays_delete", methods={"DELETE"})
     */
    public function delete(Request $request,  $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $pay = $em->getRepository('App:Pays')->find($id);
        if ($this->isCsrfTokenValid('delete'.$pay->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pays_index');
    }
}
