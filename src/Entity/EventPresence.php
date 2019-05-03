<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class EventPresence
{
    private $NoOfInningsPlayed;

    private $id;

    private $event;

    private $player;

    private $presentDuringGame;

    public function __construct()
    {
        $this->player = new ArrayCollection();
    }

    public function getNoOfInningsPlayed(): ?int
    {
        return $this->NoOfInningsPlayed;
    }

    public function setNoOfInningsPlayed(?int $NoOfInningsPlayed): self
    {
        $this->NoOfInningsPlayed = $NoOfInningsPlayed;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPlayer()
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->player->contains($player)) {
            $this->player[] = $player;
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->player->contains($player)) {
            $this->player->removeElement($player);
        }

        return $this;
    }

    public function getPresentDuringGame(): ?bool
    {
        return $this->presentDuringGame;
    }

    public function setPresentDuringGame(?bool $presentDuringGame): self
    {
        $this->presentDuringGame = $presentDuringGame;

        return $this;
    }
}
