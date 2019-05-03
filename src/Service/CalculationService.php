<?php


namespace App\Service;


use App\Entity\Player;
use App\Repository\EventRepository;

class CalculationService
{
    private $eventRepo;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepo = $eventRepository;
    }

    /**
     * return the percentage of inning played vs games total innings for games player was present.
     *
     * @param \App\Entity\Player $player
     *
     * @return float
     */
    public function getIPPercentage(Player $player)
    {
        $totalGameInningsWhenPresent = $this->getAvailableInnings($player);
        $totalInningsPlayed = $this->getNumberOfInningsPlayed($player);
        if ($totalGameInningsWhenPresent == 0) {
            return 0;
        }

        return $totalInningsPlayed / $totalGameInningsWhenPresent * 100;
    }

    /**
     * returns number of games played (player active).
     *
     * @param \App\Entity\Player $player
     *
     * @return int
     */
    public function getGPNumber(Player $player)
    {
        $games = $player->getEventPresences();
        $count = 0;
        foreach ($games as $game) {
            if ($game->getNoOfInningsPlayed() > 0 && $game->getEvent()->getType()->getName() == 'Game') {
                $count++;
            }
        }

        return $count;
    }


    /**
     * returns the number of games player was present, but might not have been playing.
     *
     *
     * @param \App\Entity\Player $player
     *
     * @return int
     */
    public function getGamesPresent(Player $player)
    {
        $games = $player->getEventPresences();
        $count = 0;
        foreach ($games as $game) {
            if ($game->getPresentDuringGame() && $game->getEvent()->getType()->getName() == 'Game') {
                $count++;
            }
        }

        return $count;
    }

    /**
     * return the number of innings played.
     *
     * @param \App\Entity\Player $player
     *
     * @return int
     */
    public function getNumberOfInningsPlayed(Player $player)
    {
        $games = $player->getEventPresences();
        $count = 0;
        foreach ($games as $game) {
            if ($game->getEvent()->getType()->getName() == 'Game') {
                $count = $count + $game->getNoOfInningsPlayed();
            }
        }

        return $count;
    }

    /**
     * returns the number of inning available over all games present
     *
     * @param \App\Entity\Player $player
     *
     * @return int
     */
    public function getAvailableInnings(Player $player)
    {
        $allGames = $this->eventRepo->findAll();
        $totalGameInnings = 0;
        foreach ($allGames as $game) {
            if ($game->getType()->getName() == 'Game') {
                foreach ($game->getPresences() as $gamePressence) {
                    if ($gamePressence->getPlayer() === $player) {
                        if ($gamePressence->getPresentDuringGame()) {
                            $totalGameInnings = $totalGameInnings + $game->getNoOfInnings();
                        }
                    }
                }
            }
        }

        return $totalGameInnings;
    }

    /**
     * returns the average training presents.
     *
     * @param \App\Entity\Player $player
     *
     * @return float
     */
    public function getAvgTrainingPres(Player $player)
    {
        $totalTrainings = $this->getTotalTraining();
        $trainingPresents = $this->getTrainingsPresent($player);
        if ($totalTrainings < 1) {
            return 0.0;
        }

        return $trainingPresents / $totalTrainings * 100;
    }

    private function getTotalTraining()
    {
        $totalTrainings = 0;

        $allGames = $this->eventRepo->findAll();
        foreach ($allGames as $game) {
            if ($game->getType()->getName() == 'Training') {
                $totalTrainings++;
            }
        }

        return $totalTrainings;
    }

    private function getTrainingsPresent(Player $player)
    {
        $trainingPresents = 0;
        foreach ($player->getEventPresences() as $presence) {
            if ($presence->getEvent()->getType()->getName() == 'Training') {
                $trainingPresents++;
            }
        }

        return $trainingPresents;
    }

    /**
     * returns the ratio for:
     * number of inning vs the number of trainings present
     * expressed in a ratio number
     *
     * @param \App\Entity\Player $player
     *
     * @return float
     *
     */
    public function getI2TNumber(Player $player)
    {
        $totalGameInningsWhenPresent = $this->getAvailableInnings($player);
        $totalInningsPlayed = $this->getNumberOfInningsPlayed($player);
        $totalTrainings = $this->getTotalTraining();
        $totalTrainingPresent = $this->getTrainingsPresent($player);
        if ($totalTrainings == 0 || $totalGameInningsWhenPresent == 0) {
            return 1;
        }
        $sum = ($totalTrainingPresent / $totalTrainings) / ($totalInningsPlayed / $totalGameInningsWhenPresent);

        return $sum;
    }
}
