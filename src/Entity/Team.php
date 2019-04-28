<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Team
{
    private $name;

    private $id;

    private $player;

    public function __construct()
    {
        $this->player = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->player->contains($player)) {
            $this->player[] = $player;
            $player->setId($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->player->contains($player)) {
            $this->player->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getId() === $this) {
                $player->setId(null);
            }
        }

        return $this;
    }
}
