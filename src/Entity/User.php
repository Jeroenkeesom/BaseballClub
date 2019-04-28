<?php


namespace App\Entity;


use FOS\UserBundle\Model\User as BaseUser;


class User extends BaseUser
{

    /**
     * @var int
     */
    protected $id;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
