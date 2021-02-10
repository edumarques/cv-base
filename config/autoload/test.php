<?php

declare(strict_types=1);

use Cv\Factory\CvControllerFactory;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDO\SQLite\Driver::class,
                'params'      => [
                    'path' => __DIR__ . '/../../db/test_db.sqlite3',
                ],
            ],
        ],
    ],
    CvControllerFactory::CV_STORAGE_PATH => __DIR__ . '/../../data/cvs-test/',
];
