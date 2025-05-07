<?php

namespace TYPO3Incubator\SurfcampEvents\Service;

use TYPO3Incubator\SurfcampEvents\Domain\Model\Event;
use TYPO3Incubator\SurfcampEvents\Domain\Model\Registration;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\RegistrationRepository;
use TYPO3Incubator\SurfcampEvents\Enumeration\RegistrationStatus;

final class RegistrationService
{
    public function __construct(
        protected RegistrationRepository $registrationRepository,
    )
    {}

    public function processRegistration(Event $event, string $email): int
    {
        // Check for email validity
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return RegistrationStatus::STATUS_INVALID_EMAIL;
        }

        // Check if maximum capacity isn't reached yet
        $registeredAttendeeCount = $this->registrationRepository->findAttendeeCountByEvent($event);
        if ($registeredAttendeeCount >= $event->getMaximumAttendeeCapacity()) {
            return RegistrationStatus::STATUS_MAX_CAPACITY_REACHED;
        }

        // Check if email was already registered for event
        if ($this->registrationRepository->findEmailAlreadyRegisteredByEvent($event, $email)) {
            return RegistrationStatus::STATUS_ALREADY_REGISTERED;
        }

        $this->persistNewRegistration($event, $email);
        return RegistrationStatus::STATUS_SUCCESSFUL;
    }

    private function persistNewRegistration(Event $event, string $email): void
    {
        $registration = new Registration();
        $registration->setEvent($event);
        $registration->setEmail($email);
        $this->registrationRepository->add($registration);
    }
}
