<?php

namespace TYPO3Incubator\SurfcampEvents\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Appointment extends AbstractDomainObject
{
    /**
     * @var string
     */
    protected string $title = '';
    protected string $description = '';
    protected int $start_date_time = 0;
    protected int $end_date_time = 0;
    /** @var Location|null  */
    protected mixed $location = null;
    /** @var ObjectStorage<Registration>  */
    protected $registration = null;
    protected int $maximumAttendeeCapacity = 0;
    protected bool $is_open_for_registrations = false;

    protected function initStorageObjects(): void
    {
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

    public function getStartDateTime(): int
    {
        return $this->start_date_time;
    }

    public function setStartDateTime(int $start_date_time): void
    {
        $this->start_date_time = $start_date_time;
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

    public function getRegistration(): ObjectStorage
    {
        return $this->registration;
    }

    public function setRegistration(null $registration): void
    {
        $this->registration = $registration;
    }

    public function getMaximumAttendeeCapacity(): int
    {
        return $this->maximumAttendeeCapacity;
    }

    public function setMaximumAttendeeCapacity(int $maximumAttendeeCapacity): void
    {
        $this->maximumAttendeeCapacity = $maximumAttendeeCapacity;
    }

    public function getIsOpenForRegistrations(): bool
    {
        return $this->is_open_for_registrations;
    }

    public function setIsOpenForRegistrations(bool $is_open_for_registrations): void
    {
        $this->is_open_for_registrations = $is_open_for_registrations;
    }
}
