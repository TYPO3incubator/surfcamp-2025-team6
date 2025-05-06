<?php

namespace TYPO3Incubator\SurfcampEvents\Controller;

use AllowDynamicProperties;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Incubator\SurfcampEvents\Domain\Model\Event;
use TYPO3Incubator\SurfcampEvents\Domain\Model\Registration;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\EventRepository;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\RegistrationRepository;

class RegistrationController extends ActionController
{
    public function __construct(
        protected RegistrationRepository $registrationRepository,
    )
    {}

    public function confirmRegistrationAction(Event $event, string $email): ResponseInterface
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addFlashMessage(
                'Please provide a valid email address.',
                'Invalid email address provided.',
                ContextualFeedbackSeverity::ERROR
            );
            return $this->redirect('registration', 'Event');
        }

        $registration = new Registration();
        $registration->setEvent($event);
        $registration->setEmail($email);
        $this->registrationRepository->add($registration);

        $this->addFlashMessage(
            'Your registration has been confirmed.',
            'Successful registration.',
            ContextualFeedbackSeverity::OK
        );
        return $this->redirect('registration', 'Event');
    }
}
