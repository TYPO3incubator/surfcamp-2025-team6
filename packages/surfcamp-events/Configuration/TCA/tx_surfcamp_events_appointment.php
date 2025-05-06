<?php

$timezoneService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3Incubator\SurfcampEvents\Service\TimezoneService::class);

return [
    'ctrl' => [
        'title' => 'Appointment',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,description',
//        'iconfile' => 'EXT:myeventextension/Resources/Public/Icons/Appointment.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'event, title, description, start_date_time, end_date_time, timezone, location, registration',
    ],
    'types' => [
        '1' => ['showitem' => 'event, title, description, start_date_time, end_date_time, timezone, location, registration'],
    ],
    'columns' => [
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim',
            ],
        ],
        'description' => [
            'label' => 'Description',
            'config' => [
                'type' => 'text',
                'rows' => 5,
                'cols' => 40,
            ],
        ],
        'start_date_time' => [
            'label' => 'Start Date & Time',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'start_date_time_utc' => [
            'label' => 'Start Date & Time [UTC]',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'end_date_time' => [
            'label' => 'End Date & Time',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'end_date_time_utc' => [
            'label' => 'End Date & Time [UTC]',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'timezone' => [
            'label' => 'Timezone',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array_map(function($tz) {
                    return [$tz, $tz];
                }, \DateTimeZone::listIdentifiers()),
                'default' => $timezoneService->getUserTimezone(),
            ],
        ],
        'tzdb_version' => [
            'label' => 'tzdb version',
            'config' => [
                'type' => 'input',
            ],
        ],
        'location' => [
            'label' => 'Location',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_surfcamp_events_location',
            ],
        ],
        'registration' => [
            'label' => 'Registrations',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_surfcamp_events_registration',
                'foreign_field' => 'registration',
            ],
        ],
    ],
];
