<?php

namespace TYPO3Incubator\SurfcampEvents\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Event extends AbstractDomainObject
{
    /**
     * @var string
     */
    protected string $title = '';

    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @var string
     */
    protected string $event_type = '';

    /**
     * @var int
     */
    protected int $start_date_time = 0;

    /**
     * @var int
     */
    protected int $end_date_time = 0;

    /**
     * @var null|ObjectStorage<Appointment>
     */
    protected $appointment = null;

    /**
     * @var null|ObjectStorage<Registration>
     */
    protected $registration = null;

    /**
     * @var Location|null
     */
    protected mixed $location = null;

    /**
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->appointment = new ObjectStorage();
        $this->registration = new ObjectStorage();
    }

    public function __construct()
    {
        $this->initStorageObjects();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getEventType(): string
    {
        return $this->event_type;
    }

    public function setEventType(string $event_type): void
    {
        $this->event_type = $event_type;
    }

    public function getStartDateTime(): string
    {
        return $this->start_date_time;
    }

    public function getEndDateTime(): int
    {
        return $this->end_date_time;
    }

    public function setEndDateTime(int $end_date_time): void
    {
        $this->end_date_time = $end_date_time;
    }

    public function getLocation(): mixed
    {
        return $this->location;
    }

    public function setLocation(mixed $location): void
    {
        $this->location = $location;
    }
}
