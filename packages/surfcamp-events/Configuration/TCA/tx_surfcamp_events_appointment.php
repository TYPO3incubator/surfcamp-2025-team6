<?php

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
        'showRecordFieldList' => 'event, title, description, start_date_time, end_date_time, location',
    ],
    'types' => [
        '1' => ['showitem' => 'event, title, description, start_date_time, end_date_time, location'],
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
        'end_date_time' => [
            'label' => 'End Date & Time',
            'config' => [
                'type' => 'datetime',
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
    ],
];
