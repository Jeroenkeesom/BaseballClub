<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractFOSRestController
{
    /**
     * @Route("/api/", name="api_default")
     */
    public function defaultAction()
    {
        $response = array ('notice' => 'API support following soon');
        $view = $this->view($response, 200);

        return $this->handleView($view);
    }
}
