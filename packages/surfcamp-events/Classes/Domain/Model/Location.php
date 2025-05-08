<?php

namespace TYPO3Incubator\SurfcampEvents\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class Location extends AbstractDomainObject
{
    /**
     * @var string
     */
    protected string $name = '';

    /**
     * @var string
     */
    protected string $timezone = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }
}
