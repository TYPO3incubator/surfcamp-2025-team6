<?php

namespace TYPO3Incubator\SurfcampEvents\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

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
     * @var string
     */
    protected string $start_date_time = '';

    /**
     * @var string
     */
    protected string $end_date_time = '';

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

    public function setStartDateTime(string $start_date_time): void
    {
        $this->start_date_time = $start_date_time;
    }

    public function getEndDateTime(): string
    {
        return $this->end_date_time;
    }

    public function setEndDateTime(string $end_date_time): void
    {
        $this->end_date_time = $end_date_time;
    }
}
