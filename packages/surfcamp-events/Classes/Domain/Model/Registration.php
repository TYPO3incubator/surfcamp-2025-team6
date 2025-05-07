<?php

namespace TYPO3Incubator\SurfcampEvents\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Registration extends AbstractDomainObject
{
    /** @var null | ObjectStorage<Event> */
    protected mixed $event;
    /** @var null | ObjectStorage<Appointment> */
    protected mixed $appointment;
    protected string $email;

    protected function initStorageObjects(): void
    {
        $this->appointment = new ObjectStorage();
        $this->registration = new ObjectStorage();
    }

    public function __construct()
    {
        $this->initStorageObjects();
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    public function getAppointment(): Appointment
    {
        return $this->appointment;
    }

    public function setAppointment(ObjectStorage $appointment): void
    {
        $this->appointment = $appointment;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
