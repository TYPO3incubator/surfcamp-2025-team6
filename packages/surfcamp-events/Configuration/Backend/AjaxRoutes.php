<?php

use TYPO3Incubator\SurfcampEvents\Controller\Backend\EventGeneratorBackendModuleController;

return [
    'surfcamp_events_appointments_pregenerate' => [
        'path' => '/events-management/appointments/pregenerate',
        'target' => EventGeneratorBackendModuleController::class . '::pregenerateAppointments',
    ],
];
