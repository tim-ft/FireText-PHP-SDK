<?php

return [
    'app' => [
        'env' => 'local'
    ],
    'logging' => [
        'default' => 'single',
        'channels' => [
            'single' => [
                'driver' => 'single',
                'path' => __DIR__ . '/logs/app.log',
                'level' => 'debug',
            ],
        ],
    ],
];