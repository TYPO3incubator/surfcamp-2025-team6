<?php

return [
    'ctrl' => [
        'title' => 'Location',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'name,address',
//        'iconfile' => 'EXT:myeventextension/Resources/Public/Icons/Event.svg',
        'security' => [
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'interface' => [
        'showRecordFieldList' => 'name, street, street_nr, zip, city, country, long, lat',
    ],
    'types' => [
        '1' => ['showitem' => 'name, street, street_nr, zip, city, country, long, lat'],
    ],
    'columns' => [
        'name' => [
            'label' => 'Name',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim',
            ],
        ],
        'street' => [
            'label' => 'Street',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim',
            ],
        ],
        'street_nr' => [
            'label' => 'Street no',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim',
            ],
        ],
        'zip' => [
            'label' => 'Post code',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim',
            ],
        ],
        'city' => [
            'label' => 'City',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim',
            ],
        ],
        'country' => [
            'label' => 'Country',
            'config' => [
                'type' => 'input',
                'eval' => 'required,trim',
            ],
        ],
        'lat' => [
            'label' => 'Latitute',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
            ],
        ],
        'long' => [
            'label' => 'Longitude',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
            ],
        ],
    ],
];
