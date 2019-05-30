<?php


namespace App\Controller;


use App\Entity\Event;
use App\Entity\EventPresence;
use App\Entity\EventType;
use App\Entity\Player;
use App\Form\EventFormType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{

    /**
     * @Route("/new-training", name="newTraining")
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newGame(Request $request)
    {
        $game = new Event();
        $game->setNoOfInnings(0);
        $game->setType($this->getDoctrine()->getRepository(EventType::class)->findOneBy(['name' => 'Training']));
        $form = $this->createForm(EventFormType::class, $game, ['is_game' => false]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            try {
                $em->flush();
            } catch (Exception $e) {
                $this->addFlash('error', 'training for date: '.$game->getDate()->format('d-M-y').' was already entered please use the edit training to adjust!');

                return $this->redirectToRoute('default');
            }
            $this->addFlash('success', 'training with id: '.$game->getId().' created!');

            return $this->redirectToRoute('register-training-presence', ['gameId' => $game->getId()]);
        }

        return $this->render(
            'training.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/regiser-training-presence", name="register-training-presence")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerPresence(Request $request)
    {
        if ($request->getMethod() == 'POST') {

            $playedInningArray = $request->request->get('present');
            $gameId = (int)$request->request->get('gameId');
            $game = $this->getDoctrine()->getRepository(Event::class)->find($gameId);
            $em = $this->getDoctrine()->getManager();

            foreach ($playedInningArray as $playerId => $present) {
                $presence = new EventPresence();
                $presence->setEvent($game);
                $presence->setPlayer($this->getDoctrine()->getRepository(Player::class)->find($playerId));
                $presence->setNoOfInningsPlayed(0);
                $em->persist($presence);
            }
            $em->flush();
            $this->addFlash('success', 'presence has been registered');

            return $this->redirectToRoute('default');
        }
        $gameId = (int)$request->query->get('gameId');

        if ($gameId == 0) {
            $this->addFlash('error', 'something went wrong: error 104-default');
            $this->redirectToRoute('newTraining');
        }
        $game = $this->getDoctrine()->getRepository(Event::class)->find($gameId);
        $players = $this->getDoctrine()->getRepository(Player::class)->findBy(['active' => true]);
        $presence = new EventPresence();
        $presence->setEvent($game);

        return $this->render(
            'training-presence.html.twig',
            [
                'players' => $players,
                'game_id' => $game->getId(),
            ]
        );
    }
}
