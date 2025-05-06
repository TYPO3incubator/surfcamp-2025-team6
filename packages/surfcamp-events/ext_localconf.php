<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3Incubator\SurfcampEvents\Controller\EventController;
use TYPO3Incubator\SurfcampEvents\Controller\RegistrationController;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    'SurfcampEvents',
    'EventList',
    [
        EventController::class => 'list, eventDetail',
    ], [
        EventController::class => 'list, eventDetail',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
    'SurfcampEvents',
    'EventRegistration',
    [EventController::class => 'registration', RegistrationController::class => 'confirmRegistration'],
    [EventController::class => 'registration', RegistrationController::class => 'confirmRegistration'],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
