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
//        'iconfile' => 'EXT:myeventextension/Resources/Public/Icons/Registration.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'title, email, event, appointment',
    ],
    'types' => [
        '1' => ['showitem' => 'title, email, event, appointment'],
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
    ],
];
