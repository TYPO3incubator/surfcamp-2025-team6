<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3Incubator\SurfcampEvents\Controller\EventController;
use TYPO3Incubator\SurfcampEvents\Controller\RegistrationController;
use TYPO3Incubator\SurfcampEvents\Form\Element\SelectWithTimezoneValidation;
use TYPO3Incubator\SurfcampEvents\Controller\RegistrationController;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    'SurfcampEvents',
    'EventList',
    [EventController::class => 'list, detail', RegistrationController::class => 'processRegistration'],
    [EventController::class => 'list, detail', RegistrationController::class => 'processRegistration'],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][] = [
    'nodeName' => 'selectSingleWithTimezoneValidation',
    'priority' => 50,
    'class' => SelectWithTimezoneValidation::class,
];

ExtensionUtility::configurePlugin(
    'SurfcampEvents',
    'EventRegistration',
    [EventController::class => 'registration', RegistrationController::class => 'confirmRegistration'],
    [EventController::class => 'registration', RegistrationController::class => 'confirmRegistration'],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
