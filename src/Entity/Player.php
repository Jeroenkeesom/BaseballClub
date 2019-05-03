<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Player
{
    private $active;

    private $firstName;

    private $lastName;

    private $nickName;

    private $shirtNumber;

    private $preferredPosition;

    private $activeSince;

    private $id;

    private $team;

    private $playerType;

    private $eventPresences;

    public function __construct()
    {
        $this->eventPresences = new ArrayCollection();
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNickName(): ?string
    {
        return $this->nickName;
    }

    public function setNickName(string $nickName): self
    {
        $this->nickName = $nickName;

        return $this;
    }

    public function getShirtNumber(): ?int
    {
        return $this->shirtNumber;
    }

    public function setShirtNumber(?int $shirtNumber): self
    {
        $this->shirtNumber = $shirtNumber;

        return $this;
    }

    public function getPreferredPosition(): ?string
    {
        return $this->preferredPosition;
    }

    public function setPreferredPosition(?string $preferredPosition): self
    {
        $this->preferredPosition = $preferredPosition;

        return $this;
    }

    public function getActiveSince(): ?DateTimeInterface
    {
        return $this->activeSince;
    }

    public function setActiveSince(?DateTimeInterface $activeSince): self
    {
        $this->activeSince = $activeSince;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getPlayerType(): ?string
    {
        return $this->playerType;
    }

    public function setPlayerType(string $playerType): self
    {
        $this->playerType = $playerType;

        return $this;
    }

    /**
     * @return Collection|EventPresence[]
     */
    public function getEventPresences(): Collection
    {
        return $this->eventPresences;
    }

    public function addEventPresence(EventPresence $eventPresence): self
    {
        if (!$this->eventPresences->contains($eventPresence)) {
            $this->eventPresences[] = $eventPresence;
            $eventPresence->setPlayer($this);
        }

        return $this;
    }

    public function removeEventPresence(EventPresence $eventPresence): self
    {
        if ($this->eventPresences->contains($eventPresence)) {
            $this->eventPresences->removeElement($eventPresence);
            // set the owning side to null (unless already changed)
            if ($eventPresence->getPlayer() === $this) {
                $eventPresence->setPlayer(null);
            }
        }

        return $this;
    }
}
