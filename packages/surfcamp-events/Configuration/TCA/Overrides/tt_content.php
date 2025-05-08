<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

// Register plugin
ExtensionUtility::registerPlugin(
    'SurfcampEvents',
    'EventList',
    'List of all available Events',
    'content-trophy',
    'surfcamp-events'
);

ExtensionUtility::registerPlugin(
    'SurfcampEvents',
    'EventRegistration',
    'Registration for Event',
    'form-fieldset',
    'surfcamp-events'
);

ExtensionUtility::registerPlugin(
    'SurfcampEvents',
    'EventLocationsMap',
    'Events by Location on Map',
    'content-pin',
    'surfcamp-events'
);

