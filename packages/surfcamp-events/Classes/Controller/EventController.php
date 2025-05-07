<?php

namespace TYPO3Incubator\SurfcampEvents\Controller;

use AllowDynamicProperties;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\EventRepository;

class EventController extends ActionController
{

    public function __construct(
        private readonly EventRepository $eventRepository,
    )
    {
    }
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

    /**
     * Get the Events Locations
     * @return ResponseInterface
     */
    public function locationsMapAction(): ResponseInterface
    {
        $events = $this->eventRepository->findAll();

        $locations = [];
        foreach ($events as $event) {
            $location = $event->getLocation();
            if ($location !== null && $location->getLatitude() !== null && $location->getLongitude() !== null) {
                $locations[] = [
                    'lat' => $location->getLatitude(),
                    'lng' => $location->getLongitude(),
                    'title' => $event->getTitle()
                ];
            }
        }

        $this->view->assignMultiple([
            'locations' => $locations,
            'events' => $events,
        ]);

        return $this->htmlResponse();
    }

    // /**
    //  * The List Action
    //  * @return ResponseInterface
    //  */
    // public function listByLocationAction(float $latitude = null, float $longitude = null, float $radiusKm = 10.0): ResponseInterface
    // {

    //     if ($lat === null || $lng === null) {
    //         $events = $this->eventRepository->findAll();
    //     } else {
    //         $events = $this->eventRepository->findByLocation($lat, $lng, $radiusKm);
    //     }

    //     // $events = $this->eventRepository->findByLocation($latitude, $longitude, $radiusKm);
    //     $this->view->assign('events', $events);

    //     return $this->htmlResponse();
    // }
}
