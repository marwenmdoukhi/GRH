<?php

namespace App\Controller;

use App\Entity\User;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @param User $user
     * @return RedirectResponse|Response
     * @Route("/admin/activer/{id}", name="useractiver")

     */
    public function show($id) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->find($id);

        //  var_dump($user); exit();
        if ($user->isEnabled()){
            $user->setEnabled(0);
        } else{
            $user->setEnabled(1);
        }
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('user_active');
    }
    /**
     * @param Request $request
     * @param User $user
     * @return Response
     * @Route("/editer/{id}", name="user_edit")
     */
    public function editAction(Request $request,  $id) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('App:User')->find($id);

        $editForm = $this->createForm('App\Form\UserEditType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return new Response(0);
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     * @Route("/editerphoto/{id}", name="user_edit_photo")
     */
    public function editPhoto(Request $request, $id ) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('App:User')->find($id);

        $editForm = $this->createForm('App\Form\UserEditPhotoType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $uploadedFile = $editForm['photo']->getData();
            if ($uploadedFile){
                $destination = $this->getParameter('brochures_directory') ;
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $user->setPhoto($newFilename);
            }
            $this->getDoctrine()->getManager()->flush();

            return new Response(0);
        }

        return $this->render('user/edit_photo.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }
}
