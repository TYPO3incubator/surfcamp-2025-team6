<?php

declare(strict_types=1);

return [
    \TYPO3Incubator\SurfcampEvents\Domain\Model\Event::class => [
        'tableName' => 'tx_surfcamp_events_event',
        'properties' => [
            'event_type' => [
                'fieldName' => 'event_type',
            ],
            'start_date_time' => [
                'fieldName' => 'start_date_time',
            ],
            'end_date_time' => [
                'fieldName' => 'end_date_time',
            ],
            'is_open_for_registrations' => [
                'fieldName' => 'is_open_for_registrations',
            ]
        ],
    ],
    \TYPO3Incubator\SurfcampEvents\Domain\Model\Appointment::class => [
        'tableName' => 'tx_surfcamp_events_appointment',
        'properties' => [
            // 'administratorName' => [
            //     'fieldName' => 'username',
            // ],
        ],
    ],
    \TYPO3Incubator\SurfcampEvents\Domain\Model\Location::class => [
        'tableName' => 'tx_surfcamp_events_location',
        'properties' => [
            // 'administratorName' => [
            //     'fieldName' => 'username',
            // ],
        ],
    ],
    \TYPO3Incubator\SurfcampEvents\Domain\Model\Registration::class => [
        'tableName' => 'tx_surfcamp_events_registration',
        'properties' => [
            // 'administratorName' => [
            //     'fieldName' => 'username',
            // ],
        ],
    ],
];
