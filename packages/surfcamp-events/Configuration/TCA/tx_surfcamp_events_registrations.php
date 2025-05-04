<?php

return [
    'ctrl' => [
        'title' => 'Registration',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'name,email',
        'iconfile' => 'EXT:myeventextension/Resources/Public/Icons/Registration.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'name, email, event, appointment',
    ],
    'types' => [
        '1' => ['showitem' => 'name, email, event, appointment'],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim',
            ],
        ],
        'email' => [
            'label' => 'Email',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim,email',
            ],
        ],
        'event' => [
            'exclude' => true,
            'label' => 'Event',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_surfcamp_events_events',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'appointment' => [
            'exclude' => true,
            'label' => 'Appointment',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_surfcamp_events_appointments',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
];
