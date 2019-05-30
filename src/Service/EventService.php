<?php


namespace App\Service;


use App\Entity\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;

class EventService
{
    private $eventRepo;

    private $em;

    public function __construct(EventRepository $eventRepository, EntityManagerInterface $em)
    {
        $this->eventRepo = $eventRepository;
        $this->em = $em;
    }

    /**
     * @param \App\Entity\EventType $type
     *
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getLastedEvent(EventType $type)
    {
        return $this->eventRepo->getLatestEventOfType($type);
    }

    public function getEventType(string $typeName)
    {
        return $this->em->getRepository(EventType::class)->findOneBy(['name' => $typeName]);
    }

}
