<?php declare(strict_types=1);

return [
    'default' => env('ELASTIC_CONNECTION', 'elastic'),
    'connections' => [
        'elastic' => [
            'hosts' => [
                env('ELASTIC_HOST', 'localhost:9200'),
            ],
        ],
    ],
];
