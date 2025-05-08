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
     * @var \DateTime|null
     */
    protected ?\DateTime $start_date_time = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $start_date_time_utc = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $end_date_time = null;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $end_date_time_utc = null;

    /**
     * @var string
     */
    protected string $timezone = '';

    /**
     * @var string
     */
    protected string $tzdb_version = '';

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

    protected int $maximumAttendeeCapacity = 0;
    protected bool $is_open_for_registrations = false;

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

    public function setStartDateTime(\DateTime $dateTime): void
    {
        $this->start_date_time = $dateTime;
    }

    public function getStartDateTime(): ?\DateTime
    {
        return $this->start_date_time;
    }

    public function getEndDateTime(): ?\DateTime
    {
        return $this->end_date_time;
    }

    public function setEndDateTime(\DateTime $end_date_time): void
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

    public function getAppointment(): ?ObjectStorage
    {
        return $this->appointment;
    }

    public function setAppointment(?ObjectStorage $appointment): void
    {
        $this->appointment = $appointment;
    }

    public function getRegistration(): ?ObjectStorage
    {
        return $this->registration;
    }

    public function setRegistration(?ObjectStorage $registration): void
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

    public function setIsOpenForRegistrations(bool $isOpenForRegistrations): void
    {
        $this->is_open_for_registrations = $isOpenForRegistrations;
    }

    public function getStartDateTimeUtc(): ?\DateTime
    {
        return $this->start_date_time_utc;
    }

    public function setStartDateTimeUtc(\DateTime $start_date_time_utc): void
    {
        $this->start_date_time_utc = $start_date_time_utc;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    public function getTzdbVersion(): string
    {
        return $this->tzdb_version;
    }

    public function setTzdbVersion(string $tzdb_version): void
    {
        $this->tzdb_version = $tzdb_version;
    }

    public function getEndDateTimeUtc(): ?\DateTime
    {
        return $this->end_date_time_utc;
    }

    public function setEndDateTimeUtc(\DateTime $end_date_time_utc): void
    {
        $this->end_date_time_utc = $end_date_time_utc;
    }
}
