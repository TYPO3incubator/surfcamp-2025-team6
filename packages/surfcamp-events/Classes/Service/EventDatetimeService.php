<?php

declare(strict_types=1);

namespace TYPO3Incubator\SurfcampEvents\Service;

use DateTime;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3Incubator\SurfcampEvents\Domain\Model\Appointment;
use TYPO3Incubator\SurfcampEvents\Domain\Model\Event;
use TYPO3Incubator\SurfcampEvents\Domain\Model\StartEndDatetimeInterface;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\AppointmentRepository;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\EventRepository;

class EventDatetimeService
{
    public function __construct(
        private TimezoneService $timezoneService,
        private EventRepository $eventRepository,
        private AppointmentRepository $appointmentRepository,
        private PersistenceManager $persistenceManager,
    ) {}

    public function getEventStartDateInTimezone(Event $event, string $timezone): ?string
    {
        if (!$event->getStartDateTimeUtc()) {
            return null;
        }

        if ($event->getTzdbVersion() !== $this->timezoneService->getTimezoneVersion()) {
            $event = $this->updateEventUTC($event);
        }

        $utc = $event->getStartDateTimeUtc()->format('Y-m-d\TH:i:s\Z');
        return $this->convertToTimezone($utc, $timezone);
    }

    public function getEventEndDateInTimezone(Event $event, string $timezone): ?string
    {
        if (!$event->getEndDateTimeUtc()) {
            return null;
        }

        if ($event->getTzdbVersion() !== $this->timezoneService->getTimezoneVersion()) {
            $event = $this->updateEventUTC($event);
        }

        $utc = $event->getEndDateTimeUtc()->format('Y-m-d\TH:i:s\Z');
        return $this->convertToTimezone($utc, $timezone);
    }

    public function getAppointmentStartDateInTimezone(Appointment $appointment, string $timezone): ?string
    {
        if (!$appointment->getStartDateTimeUtc()) {
            return null;
        }

        if ($appointment->getTzdbVersion() !== $this->timezoneService->getTimezoneVersion()) {
            $appointment = $this->updateAppointmentUTC($appointment);
        }

        $utc = $appointment->getStartDateTimeUtc()->format('Y-m-d\TH:i:s\Z');
        return $this->convertToTimezone($utc, $timezone);
    }

    public function getAppointmentEndDateInTimezone(Appointment $appointment, string $timezone): ?string
    {
        if (!$appointment->getEndDateTimeUtc()) {
            return null;
        }

        if ($appointment->getTzdbVersion() !== $this->timezoneService->getTimezoneVersion()) {
            $appointment = $this->updateAppointmentUTC($appointment);
        }

        $utc = $appointment->getEndDateTimeUtc()->format('Y-m-d\TH:i:s\Z');
        return $this->convertToTimezone($utc, $timezone);
    }

    private function updateEventUTC(Event $event): Event
    {
        $event = $this->updateStartEndDateTime($event);
        $this->eventRepository->update($event);
        $this->persistenceManager->persistAll();
        return $event;
    }

    private function updateAppointmentUTC(Appointment $appointment): Appointment
    {
        $appointment = $this->updateStartEndDateTime($appointment);
        $this->appointmentRepository->update($appointment);
        $this->persistenceManager->persistAll();
        return $appointment;
    }

    private function updateStartEndDateTime(StartEndDatetimeInterface $object): StartEndDatetimeInterface
    {
        $startDate = $object->getStartDateTime()->format('Y-m-d\TH:i:s');
        $utcString = $this->timezoneService->convertToUTC($startDate, $object->getTimezone());
        $object->setStartDateTimeUtc(new DateTime($utcString));

        $startDate = $object->getEndDateTime()->format('Y-m-d\TH:i:s');
        $utcString = $this->timezoneService->convertToUTC($startDate, $object->getTimezone());
        $object->setEndDateTimeUtc(new DateTime($utcString));

        $object->setTzdbVersion($this->timezoneService->getTimezoneVersion());

        return $object;
    }

    private function convertToTimezone(string $utcDatetime, string $timezone): string
    {
        $dt = new DateTime($utcDatetime, new \DateTimeZone('UTC'));
        $dt->setTimezone(new \DateTimeZone($timezone));

        return $dt->format('Y-m-d\TH:i:s');
    }
}
