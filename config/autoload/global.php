<?php

declare(strict_types=1);

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDO\SQLite\Driver::class,
                'params'      => [
                    'path' => __DIR__ . '/../../db/db.sqlite3',
                ],
            ],
        ],
    ],
];
