<?php


namespace App\Service;


use App\Entity\Player;

class CalculationService
{
    private $playerRepo;

    private $presenceRepo;


    /**
     * return the percentage of inning played vs games total innings for games player was present.
     *
     * @param \App\Entity\Player $player
     *
     * @return float
     */
    public function getIPPercentage(Player $player)
    {
        $pre = $player->getEventPresences();
        $inningsPlayed = 0;
        $totalGameInnings = 0;
        foreach ($pre as $presence) {
            if ($presence->getEvent()->getType()->getName() == 'Game') {
                $inningsPlayed = $inningsPlayed + $presence->getNoOfInningsPlayed();
                $totalGameInnings = $totalGameInnings + $presence->getEvent()->getNoOfInnings();
            }
        }
        if ($inningsPlayed == 0) {
            return 0;
        }

        return $totalGameInnings / $inningsPlayed;
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
            if ($game->getNoOfInningsPlayed() >= 0 && $game->getEvent()->getType()->getName() == 'Game') {
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
        return 0;
    }

    /**
     * returns the average training presents over last 4 weeks.
     *
     * @param \App\Entity\Player $player
     *
     * @return float
     */
    public function getAvgTrainingPres(Player $player)
    {

        return 0.0;
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
        return 0.0;
    }
}
