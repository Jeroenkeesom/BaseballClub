<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/api/user", name="api_user")
     */
    public function index()
    {
        return $this->render('api/user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
