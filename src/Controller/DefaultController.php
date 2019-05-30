<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use App\Service\CalculationService;
use App\Service\EventService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     * @param \App\Repository\PlayerRepository $playerRepository
     * @param \App\Service\CalculationService  $calculation
     *
     * @param \App\Service\EventService        $eventService
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(PlayerRepository $playerRepository, CalculationService $calculation, EventService $eventService)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $players = $playerRepository->findBy(['active' => true]);
        $calculatedPlayerResult = [];
        foreach ($players as $player) {
            $calculatedPlayerResult[$player->getId()]['player'] = $player;
            $calculatedPlayerResult[$player->getId()]['ips'] = $calculation->getIPPercentage($player);
            $calculatedPlayerResult[$player->getId()]['gp'] = $calculation->getGPNumber($player);
            $calculatedPlayerResult[$player->getId()]['gpr'] = $calculation->getGamesPresent($player);
            $calculatedPlayerResult[$player->getId()]['ipn'] = $calculation->getNumberOfInningsPlayed($player);
            $calculatedPlayerResult[$player->getId()]['ipa'] = $calculation->getAvailableInnings($player);
            $calculatedPlayerResult[$player->getId()]['tr'] = $calculation->getAvgTrainingPres($player);
            $calculatedPlayerResult[$player->getId()]['i2t'] = $calculation->getI2TNumber($player);
        }

        return $this->render('default/index.html.twig', [
            'calculatedPlayerResult' => $calculatedPlayerResult,
            'lastTraining' => $eventService->getLastedEvent($eventService->getEventType('Training')),
            'lastGame' => $eventService->getLastedEvent($eventService->getEventType('Game')),
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

}
