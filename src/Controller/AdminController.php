<?php

namespace App\Controller;

use App\Entity\User;
use Gedmo\Sluggable\Util\Urlizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @return Response
     *  @Route("/admin/useractiv", name="user_active")
     */
    public function active() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('App:User')->findAll();

        return $this->render('admin/active.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @return Response
     *  @Route("/userindex", name="user_index")
     */
    public function index() {
        $user= $this->getUser();
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            $route = 'user/index_admin.html.twig';
        }
        elseif ($user->hasRole('ROLE_LAB')) {
            $route = 'user/index_admin.html.twig';
        }

        else {
            $route = 'user/index.html.twig';
        }
        return $this->render($route);
    }







}
