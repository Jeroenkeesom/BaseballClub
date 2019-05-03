<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Event
{
    private $type;

    private $date;

    private $NoOfInnings;

    private $id;

    private $presences;

    public function __construct()
    {
        $this->presences = new ArrayCollection();
    }

    public function getType(): ?EventType
    {
        return $this->type;
    }

    public function setType(EventType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNoOfInnings(): ?int
    {
        return $this->NoOfInnings;
    }

    public function setNoOfInnings(?int $NoOfInnings): self
    {
        $this->NoOfInnings = $NoOfInnings;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|EventPresence[]
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(EventPresence $presence): self
    {
        if (!$this->presences->contains($presence)) {
            $this->presences[] = $presence;
            $presence->setEvent($this);
        }

        return $this;
    }

    public function removePresence(EventPresence $presence): self
    {
        if ($this->presences->contains($presence)) {
            $this->presences->removeElement($presence);
            // set the owning side to null (unless already changed)
            if ($presence->getEvent() === $this) {
                $presence->setEvent(null);
            }
        }

        return $this;
    }
}
