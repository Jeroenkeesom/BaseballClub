<?php

namespace App\Entity;

use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;

class AccessToken extends BaseAccessToken
{
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
