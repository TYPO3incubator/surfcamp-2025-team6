<?php

return [
    'ctrl' => [
        'title' => 'Event',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,description',
//        'iconfile' => 'EXT:myeventextension/Resources/Public/Icons/Event.svg',
        'security' => [
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'interface' => [
        'showRecordFieldList' => 'title, description, event_type, start_date_time, end_date_time, appointment, location, registration',
    ],
    'types' => [
        '1' => ['showitem' => 'title, description, event_type, start_date_time, end_date_time, appointment, location, registration'],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'size' => 50,
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
        'event_type' => [
            'label' => 'Event Type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => 'Standard',
                        'value' => 'standard'
                    ],
                    [
                        'label' => 'Recurring',
                        'value' => 'recurring'
                    ],
                ],
                'default' => 'standard',
            ],
        ],
        'start_date_time' => [
            'label' => 'Start Date & Time',
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
        'appointment' => [
            'label' => 'Appointments',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_surfcamp_events_appointment',
                'foreign_field' => 'event',
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
