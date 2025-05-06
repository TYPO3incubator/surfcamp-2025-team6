<?php

namespace TYPO3Incubator\SurfcampEvents\Controller\Backend;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\EventRepository;
use TYPO3Incubator\SurfcampEvents\Domain\Repository\LocationRepository;

#[AsController]
final class EventGeneratorBackendModuleController extends ActionController
{
    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        private readonly UriBuilder $backendUriBuilder,
        private readonly EventRepository $eventRepository,
        private readonly LocationRepository $locationRepository,
    ) {
    }


    public function generateAppointmentsAction(): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->assign('someVar', 'someContent');
       return  $moduleTemplate->renderResponse('Backend/EventGenerator/GenerateAppointments');
    }

    public function appointmentsOverviewAction(): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->assign('someVar', 'someContent');
       return  $moduleTemplate->renderResponse('Backend/EventGenerator/AppointmentsOverview');
    }

    public function registrationsOverviewAction(): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->assign('someVar', 'someContent');
       return  $moduleTemplate->renderResponse('Backend/EventGenerator/RegistrationsOverview');
    }

    public function indexAction(): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->assign('someVar', 'someContent');

        $moduleTemplate->assignMultiple([
            'events' => $this->eventRepository->findAll(),
            'locations' => $this->locationRepository->findAll(),
            'newEventTable' => 'tx_surfcamp_events_event',
            'newLocationTable' => 'tx_surfcamp_events_location',
            'newEventReturn' => $this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'),
            'newLocationReturn' => $this->backendUriBuilder->buildUriFromRoute('events_eventsgenerator'),
            'newEventPid' => '1',
            'newLocationPid' => '1',
            ]);

        // Example of adding a page-shortcut button
        $routeIdentifier = 'events_eventsgenerator'; // array-key of the module-configuration
        $buttonBar = $moduleTemplate->getDocHeaderComponent()->getButtonBar();
        $shortcutButton = $buttonBar->makeShortcutButton()->setDisplayName('Shortcut to my action')->setRouteIdentifier($routeIdentifier);
        $shortcutButton->setArguments(['controller' => 'MyController', 'action' => 'my']);
        $buttonBar->addButton($shortcutButton, ButtonBar::BUTTON_POSITION_RIGHT);
        // Adding title, menus and more buttons using $moduleTemplate ...

        return $moduleTemplate->renderResponse('Backend/EventGenerator/Index');
    }

}
