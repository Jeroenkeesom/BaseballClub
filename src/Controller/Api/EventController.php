<?php


namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractFOSRestController
{
    /**
     * @Route("/api/v1/events", name="api_events")
     */
    public function getUserList()
    {
        $users = array ('jeroen' => 'keesom');
        $view = $this->view($users, 200);

        return $this->handleView($view);
    }
}
