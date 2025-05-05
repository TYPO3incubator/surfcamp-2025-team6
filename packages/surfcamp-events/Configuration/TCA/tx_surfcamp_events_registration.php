<?php

return [
    'ctrl' => [
        'title' => 'Registration',
        'label' => 'email',
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
        'showRecordFieldList' => 'email, event, appointment',
    ],
    'types' => [
        '1' => ['showitem' => 'email, event, appointment'],
    ],
    'columns' => [
        'email' => [
            'label' => 'Email',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim,email',
            ],
        ],
    ],
];
