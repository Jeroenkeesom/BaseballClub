<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractFOSRestController
{
    /**
     * @Route("/api/v1/users", name="api_user")
     */
    public function getUserList()
    {
        $users = array ('jeroen' => 'keesom');
        $view = $this->view($users, 200);

        return $this->handleView($view);
    }
}
