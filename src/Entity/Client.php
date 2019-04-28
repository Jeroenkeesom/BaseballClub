<?php

namespace App\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;

class Client extends BaseClient
{
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
