<?php

declare(strict_types=1);

namespace TYPO3Incubator\SurfcampEvents\Service;

class TimezoneService
{
    public function __construct(
       private GeolocationApiService $geolocationApiService
    ) {}

    public function getTimezoneVersion(): string
    {
        return timezone_version_get();
    }

    public function getUserTimezone(): ?string
    {
        $userData = $this->geolocationApiService->fetchUserData();
        if (array_key_exists('timezone', $userData)) {
            return $userData['timezone'];
        }
        return null;
    }

    public function convertToUTC(string $dateTime, string $timezone): string
    {
        $localDatetime = str_replace('Z', '', $dateTime);
        $localDatetime = explode('+', $localDatetime)[0];

        $dt = new \DateTime($localDatetime, new \DateTimeZone($timezone));
        $dt->setTimezone(new \DateTimeZone('UTC'));

        return $dt->format('Y-m-d\TH:i:s\Z');
    }

    public function convertToLocaleTime(string $dateTime, string $timezone): string
    {
        $dt = new \DateTime($dateTime, new \DateTimeZone('UTC'));
        $dt->setTimezone(new \DateTimeZone($timezone));

        return $dt->format('Y-m-d\TH:i:s');
    }
}
