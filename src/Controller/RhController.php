<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RhController extends AbstractController
{
    /**
     * @return Response
     *  @Route("/rh/users", name="emplusers")
     *     * @Security("has_role('ROLE_ROS')")

     */
    public function active() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('App:User')->userEmploye();

        return $this->render('rh/useremployer.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @param $id
     * @return RedirectResponse|Response
     * @Route("/rh/activer/{id}", name="employactiver")
     *      *     * @Security("has_role('ROLE_ROS')")

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


}
