<?php


namespace App\Controller;


use App\Entity\Event;
use App\Entity\EventPresence;
use App\Entity\EventType;
use App\Entity\Player;
use App\Form\EventFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{

    /**
     * @Route("/new-game", name="newGame")
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newGame(Request $request)
    {
        $game = new Event();
        $game->setNoOfInnings(9);
        $game->setType($this->getDoctrine()->getRepository(EventType::class)->findOneBy(['name' => 'Game']));
        $form = $this->createForm(EventFormType::class, $game, ['is_game' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
            $this->addFlash('success', 'game with id: '.$game->getId().' created!');

            return $this->redirectToRoute('register-game-presence', ['gameId' => $game->getId()]);
        }

        return $this->render(
            'game.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/regiser-game-presence", name="register-game-presence")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerPresence(Request $request)
    {
        if ($request->getMethod() == 'POST') {

            $playedInningArray = $request->request->get('no-of-innings');
            $gameId = (int)$request->request->get('gameId');
            $present = $request->request->get('present');
            $game = $this->getDoctrine()->getRepository(Event::class)->find($gameId);
            $em = $this->getDoctrine()->getManager();
            dump($gameId, $playedInningArray, $present);

            foreach ($playedInningArray as $playerId => $noOfInnings) {
                $playerPresent = false;
                if (array_key_exists($playerId, $present)) {
                    $playerPresent = true;
                }
                $presence = new EventPresence();
                $presence->setEvent($game);
                $presence->setPresentDuringGame($playerPresent);
                $presence->setPlayer($this->getDoctrine()->getRepository(Player::class)->find($playerId));
                $presence->setNoOfInningsPlayed($noOfInnings);
                $em->persist($presence);
            }
            $em->flush();
            $this->addFlash('success', 'presence has been registered');

            return $this->redirectToRoute('default');
        }
        $gameId = (int)$request->query->get('gameId');

        if ($gameId == 0) {
            $this->addFlash('error', 'something went wrong: error 104-default');
            $this->redirectToRoute('newGame');
        }
        $game = $this->getDoctrine()->getRepository(Event::class)->find($gameId);
        $players = $this->getDoctrine()->getRepository(Player::class)->findBy(['playerType' => 2, 'active' => true]);
        $presence = new EventPresence();
        $presence->setEvent($game);

        return $this->render(
            'game-presence.html.twig',
            [
                'players' => $players,
                'max_inning' => $game->getNoOfInnings(),
                'game_id' => $game->getId(),
            ]
        );
    }
}
