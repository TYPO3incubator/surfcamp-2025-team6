<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3Incubator\SurfcampEvents\Controller\EventController;
use TYPO3Incubator\SurfcampEvents\Controller\RegistrationController;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    'SurfcampEvents',
    'EventList',
    [EventController::class => 'list, detail', RegistrationController::class => 'processRegistration'],
    [EventController::class => 'list, detail', RegistrationController::class => 'processRegistration'],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
