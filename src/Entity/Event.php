<?php

namespace App\Entity;

use DateTimeInterface;

class Event
{
    private $type;

    private $date;

    private $NoOfInnings;

    private $id;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
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
}
