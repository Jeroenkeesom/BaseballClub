<?php


namespace App\Service;


use App\Entity\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;

class EventService
{
    /**
     * @var \App\Repository\EventRepository
     */
    private $eventRepo;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * EventService constructor.
     *
     * @param \App\Repository\EventRepository      $eventRepository
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
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

    /**
     * @param string $typeName
     *
     * @return \App\Entity\EventType|object|null
     */
    public function getEventType(string $typeName)
    {
        return $this->em->getRepository(EventType::class)->findOneBy(['name' => $typeName]);
    }

    /**
     * @param \App\Entity\EventType $type
     *
     * @return \App\Entity\Event[]
     */
    public function getAllEventsOfType(EventType $type)
    {
        return $this->eventRepo->findBy(['type' => $type]);
    }

    /**
     * @return \App\Entity\Event[]
     */
    public function getAllEvents()
    {
        return $this->eventRepo->findAllOrdered();
    }

    /**
     * @param int $id
     *
     * @return \App\Entity\Event|null
     */
    public function getEventDetailsForId(int $id)
    {
        return $this->eventRepo->find($id);
    }
}
