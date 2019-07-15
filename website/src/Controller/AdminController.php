<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/admin", name="posts")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/posts", name="posts_admin")
     */
    public function showPosts()
    {

    }

    /**
     * @Route("/users", name="users_admin")
     */

    public function showUsers()
    {

    }
}
