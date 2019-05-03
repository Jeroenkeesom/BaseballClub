<?php


namespace App\Service;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method validate($entity)
 */
class AbstractEntityService
{
    protected $em;

    /**
     * AbstractEntityService constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param $entity
     *
     */
    protected function validateAndSave($entity)
    {
        $this->validate($entity);
        $this->save($entity);
    }

    /**
     * @param $entity
     */
    protected function save($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * @param \DateTime $first
     * @param \DateTime $later
     *
     * @return string
     */
    protected function daysBetweenDates(DateTime $first, DateTime $later)
    {
        return $later->diff($first)->format("%a");
    }
}
