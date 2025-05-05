<?php

declare(strict_types=1);

namespace TYPO3Incubator\SurfcampEvents\Service;

class TimezoneService
{
    public function getTimezoneVersion(): string
    {
        return timezone_version_get();
    }

    public function convertToUTC(string $dateTime, string $timezone): string
    {
        $localDatetime = str_replace('Z', '', $dateTime);
        $localDatetime = explode('+', $localDatetime)[0];

        $dt = new \DateTime($localDatetime, new \DateTimeZone($timezone));
        $dt->setTimezone(new \DateTimeZone('UTC'));

        return $dt->format('Y-m-d\TH:i:s\Z');
    }
}
