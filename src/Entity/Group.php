<?php

namespace App\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;

class Group extends BaseGroup
{
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
