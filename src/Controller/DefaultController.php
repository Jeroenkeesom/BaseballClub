<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\EventType;
use App\Form\EventFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        if ($this->denyAccessUnlessGranted('ROLE_USER')) {
            $this->redirectToRoute('login');
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/login", name="login")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login()
    {
        return $this->render(
            'login.html.twig',
            [
                'error' => null,
                'last_username' => null,
            ]
        );
    }

    /**
     * @Route("/new-game", name="newGame")
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newGame(Request $request)
    {
        $game = new Event();
        $game->setType($this->getDoctrine()->getRepository(EventType::class)->findOneBy(['name' => 'Game']));
        $form = $this->createForm(EventFormType::class, $game, ['is_game' => true]);
        $form->handleRequest($request);
        dump($game->getDate());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
        }

        return $this->render(
            'game.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
