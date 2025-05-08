<?php

namespace TYPO3Incubator\SurfcampEvents\Controller;

use AllowDynamicProperties;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Incubator\SurfcampEvents\Domain\Model\Event;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\EventRepository;

final class EventController extends ActionController
{

    public function __construct(
        private readonly EventRepository $eventRepository,
    )
    {}
    /**
     * The List Action
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'events' => $this->eventRepository->findAll()
        ]);
        return $this->htmlResponse();
    }

    public function detailAction(Event $event): ResponseInterface
    {
        $this->view->assignMultiple([
            'event' => $event,
            'isInPast' => $event->getEndDateTime() != 0 && $event->getEndDateTime() < (new \DateTime())->getTimestamp()
        ]);
        return $this->htmlResponse();
    }

    /**
     * Get the Events Locations
     * @return ResponseInterface
     */
    public function locationsMapAction(): ResponseInterface
    {
        $events = $this->eventRepository->findUpcomingEvents();
        
        $locations = [];
        foreach ($events as $event) {
            
            $uri = $this->uriBuilder
            ->reset()
            ->setTargetPageUid($GLOBALS['TSFE']->id)
            ->uriFor('detail', ['event' => $event->getUid()], 'Event');

            $location = $event->getLocation();
            if ($location !== null && $location->getLatitude() !== null && $location->getLongitude() !== null) {
                $locations[] = [
                    'lat' => $location->getLatitude(),
                    'lng' => $location->getLongitude(),
                    'title' => $event->getTitle(),
                    'eventId' => $event->getUid(),
                    'eventDetailUrl' => $uri,
                ];
            }
        }

        $this->view->assignMultiple([
            'locations' => $locations,
        ]);

        return $this->htmlResponse();
    }

     /**
     * The List Action
     * @return ResponseInterface
     */
    public function timelineAction(): ResponseInterface
    {
        $this->view->assignMultiple([
            'events' => $this->eventRepository->findUpcomingEvents()
        ]);
        return $this->htmlResponse();
    }
}
