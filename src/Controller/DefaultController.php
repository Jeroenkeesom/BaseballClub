<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use App\Service\CalculationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     * @param \App\Repository\PlayerRepository $playerRepository
     * @param \App\Service\CalculationService  $calculation
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PlayerRepository $playerRepository, CalculationService $calculation)
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
            $calculatedPlayerResult[$player->getId()]['tr'] = $calculation->getAvgTrainingPres($player);
            $calculatedPlayerResult[$player->getId()]['i2t'] = $calculation->getI2TNumber($player);
        }

        return $this->render('default/index.html.twig', [
            'calculatedPlayerResult' => $calculatedPlayerResult,
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
