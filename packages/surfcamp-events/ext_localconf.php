<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3Incubator\SurfcampEvents\Controller\EventController;

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
