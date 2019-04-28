<?php

namespace App\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;

class RefreshToken extends BaseRefreshToken

{
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
