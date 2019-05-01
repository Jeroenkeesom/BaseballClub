<?php


namespace App\Controller;


use App\Entity\Player;
use App\Form\PlayerFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{

    /**
     * @Route("/player-overview", name="player_overview")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function players()
    {
        $players = $this->getDoctrine()->getRepository(Player::class)->findBy(['active' => true]);

        /** @var $players \App\Entity\Player[] */
        return $this->render('player-overview.html.twig', ['players' => $players]);
    }

    /**
     * @Route("/player-edit/{id}", name="playerEdit")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @param int                                       $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editPlayer(Request $request, int $id)
    {
        $playerId = $id;
        $player = new Player();
        if ($playerId <> 0) {
            $player = $this->getDoctrine()->getRepository(Player::class)->find($playerId);
        }
        $form = $this->createForm(PlayerFormType::class, $player);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            return $this->redirectToRoute('player_overview');
        }

        return $this->render(
            'edit_player.html.twig',
            [
                'form' => $form->createView(),
                'player' => $player,
            ]
        );

    }
}
