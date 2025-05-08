<?php

namespace TYPO3Incubator\SurfcampEvents\Controller\Backend;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Pagination\SlidingWindowPagination;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\EventRepository;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\LocationRepository;
use TYPO3Incubator\SurfcampEvents\Service\AppointmentGeneratorService;

#[AsController]
final class EventGeneratorBackendModuleController extends ActionController
{
    const ITEMS_PER_PAGE = 12;
    const MAXIMUM_LINKS = 20;

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        private readonly UriBuilder $backendUriBuilder,
        private readonly EventRepository $eventRepository,
        private readonly LocationRepository $locationRepository,
        private readonly AppointmentGeneratorService $appointmentGeneratorService,
    ) {
    }

    /**
     *
     * @return void
     */
    public function commonViewPreperation (): void
    {
        // Load Backend Module JavaScript
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->loadJavaScriptModule('@typo3-incubator/surfcamp-events/eventsmanagement_module.js');
    }

    /**
     * @return ResponseInterface
     * @throws \TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function indexAction(): ResponseInterface
    {
        $this->commonViewPreperation();
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);

        $currentPage = $this->request->hasArgument('currentPageNumber')
            ? (int)$this->request->getArgument('currentPageNumber')
            : 1;

        $search = $this->request->hasArgument('search')
            ? (string) $this->request->getArgument('search')
            : '';

        $allEvents = $this->eventRepository->findAllWithSearchTerm($search);
        $eventsPaginator = new QueryResultPaginator($allEvents, $currentPage, self::ITEMS_PER_PAGE,);
        $eventsPagination = new SlidingWindowPagination($eventsPaginator, self::MAXIMUM_LINKS,);

        $moduleTemplate->assignMultiple([
            'events' => [
                'search' => $search,
                'currentPageNumber' => $currentPage,
                'pagination' => $eventsPagination,
                'paginator' => $eventsPaginator,
                'count' => $allEvents->count(),
                'newPid' => 1,
                'newTable'=> 'tx_surfcamp_events_event',
                'newReturn' => $this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'),
            ],
            'locations' => $this->locationRepository->findAll(),
            'newLocationReturn' => $this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'),
            'newEventPid' => '1',
            'newLocationPid' => '1',
        ]);

        return $moduleTemplate->renderResponse('Backend/EventGenerator/Index');
    }

    /**
     * @return ResponseInterface
     * @throws RouteNotFoundException
     */
    public function generateAppointmentsAction(): ResponseInterface
    {
        $this->commonViewPreperation();
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        if ($this->request->hasArgument('event')) {
            $moduleTemplate->assignMultiple([
                'event' => $this->eventRepository->findByUid((int) $this->request->getArguments()['event']),
                'events' => [
                    'newPid' => 1,
                    'newTable'=> 'tx_surfcamp_events_event',
                    'newReturn' => $this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'),
                ],
            ]);
        } else {
            return $this->redirectToUri($this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'));
        }
        return  $moduleTemplate->renderResponse('Backend/EventGenerator/GenerateAppointments');
    }

    /**
     * @return ResponseInterface
     * @throws RouteNotFoundException
     */
    public function appointmentsOverviewAction(): ResponseInterface
    {
        $this->commonViewPreperation();
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        if ($this->request->hasArgument('event')) {
            $moduleTemplate->assignMultiple([
                'event' => $this->eventRepository->findByUid((int) $this->request->getArguments()['event']),
                'events' => [
                    'newPid' => 1,
                    'newTable'=> 'tx_surfcamp_events_event',
                    'newReturn' => $this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'),
                ],
            ]);
        } else {
            return $this->redirectToUri($this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'));
        }
        return  $moduleTemplate->renderResponse('Backend/EventGenerator/AppointmentsOverview');
    }

    /**
     * @throws RouteNotFoundException
     */
    public function registrationsOverviewAction(): ResponseInterface
    {
        $this->commonViewPreperation();
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        if ($this->request->hasArgument('event')) {
            $moduleTemplate->assignMultiple([
                'event' => $this->eventRepository->findByUid((int) $this->request->getArguments()['event']),
                'events' => [
                    'newPid' => 1,
                    'newTable'=> 'tx_surfcamp_events_event',
                    'newReturn' => $this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'),
                ],
            ]);
        } else {
            return $this->redirectToUri($this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'));
        }
        return  $moduleTemplate->renderResponse('Backend/EventGenerator/RegistrationsOverview');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function generateByBackendGenerator(ServerRequestInterface $request): ResponseInterface
    {
        /** @TODO: Check for valid JSON data */
        $generatorResponse = $this->appointmentGeneratorService->generateAppointments(json_decode($request->getBody()->getContents()));
        return $this->jsonResponse(json_encode($generatorResponse, JSON_PRETTY_PRINT));

    }

}
