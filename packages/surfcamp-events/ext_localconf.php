<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3Incubator\SurfcampEvents\Controller\EventController;
use TYPO3Incubator\SurfcampEvents\Form\Element\SelectWithTimezoneValidation;

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

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][] = [
    'nodeName' => 'selectSingleWithTimezoneValidation',
    'priority' => 50,
    'class' => SelectWithTimezoneValidation::class,
];
