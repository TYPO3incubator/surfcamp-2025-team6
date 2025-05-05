<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
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
