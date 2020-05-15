<?php

namespace App\Controller;

use App\Entity\TypeConger;
use App\Form\TypeCongerType;
use App\Repository\TypeCongerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/conger")
 */
class TypeCongerController extends AbstractController
{
    /**
     * @Route("/", name="type_conger_index", methods={"GET"})
     * @param TypeCongerRepository $typeCongerRepository
     * @return Response
     */
    public function index(TypeCongerRepository $typeCongerRepository): Response
    {
        return $this->render('type_conger/index.html.twig', [
            'type_congers' => $typeCongerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_conger_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $typeConger = new TypeConger();
        $form = $this->createForm(TypeCongerType::class, $typeConger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeConger);
            $entityManager->flush();

            return $this->redirectToRoute('type_conger_index');
        }

        return $this->render('type_conger/new.html.twig', [
            'type_conger' => $typeConger,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_conger_show", methods={"GET"})
     * @param TypeConger $typeConger
     * @return Response
     */
    public function show($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $typeConger = $em->getRepository('App:TypeConger')->find($id);
        return $this->render('type_conger/show.html.twig', [
            'type_conger' => $typeConger,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_conger_edit", methods={"GET","POST"})
     */
    public function edit(Request $request,$id): Response
    {
        $em = $this->getDoctrine()->getManager();

        $typeConger = $em->getRepository('App:TypeConger')->find($id);

        $em = $this->getDoctrine()->getManager();
        $typeConger = $em->getRepository('App:Pays')->find($id);
        $form = $this->createForm(TypeCongerType::class, $typeConger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_conger_index');
        }

        return $this->render('type_conger/edit.html.twig', [
            'type_conger' => $typeConger,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_conger_delete", methods={"DELETE"})
     * @param Request $request
     * @param TypeConger $typeConger
     * @return Response
     */
    public function delete(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $typeConger = $em->getRepository('App:TypeConger')->find($id);
        if ($this->isCsrfTokenValid('delete'.$typeConger->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeConger);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_conger_index');
    }
}
