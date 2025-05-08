<?php

namespace TYPO3Incubator\SurfcampEvents\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3Incubator\SurfcampEvents\Domain\Model\Event;
use TYPO3Incubator\SurfcampEvents\Enumeration\RegistrationStatus;
use TYPO3Incubator\SurfcampEvents\Service\RegistrationService;

class RegistrationController extends ActionController
{
    public function __construct(
        protected RegistrationService $registrationService,
    )
    {}

    public function processRegistrationAction(Event $event, string $email): ResponseInterface
    {
        switch ($this->registrationService->processRegistration($event, $email)) {
            case RegistrationStatus::STATUS_INVALID_EMAIL:
                $this->addFlashMessage(
                    'Please provide a valid email address.',
                    'Invalid email address provided.',
                    ContextualFeedbackSeverity::ERROR
                );
                return $this->redirect(
                    'detail',
                    'Event',
                    '',
                    ["event" => $event]
                );
            case RegistrationStatus::STATUS_MAX_CAPACITY_REACHED:
                $this->addFlashMessage(
                    'Number of maximum attendees already reached.',
                    'Registration denied',
                    ContextualFeedbackSeverity::WARNING
                );
                return $this->redirect(
                    'detail',
                    'Event',
                    '',
                    ["event" => $event]
                );
            case RegistrationStatus::STATUS_ALREADY_REGISTERED:
                $this->addFlashMessage(
                    'This Email address was already registered.',
                    'Already registered.',
                );
                return $this->redirect(
                    'detail',
                    'Event',
                    '',
                    ["event" => $event]
                );
            default:
                $this->addFlashMessage(
                    'Your registration has been confirmed.',
                    'Successful registration.',
                );
                return $this->redirect(
                    'detail',
                    'Event',
                    '',
                    ["event" => $event]
                );
        }
    }
}
