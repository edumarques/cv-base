<?php

declare(strict_types=1);

namespace Cv;

use Cv\Controller\CvController;
use Cv\Factory\CvControllerFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Http\PhpEnvironment\RemoteAddress;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router'       => [
        'routes' => [
            'send-cv' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/cv/send',
                    'defaults' => [
                        'controller' => CvController::class,
                        'action'     => 'send',
                    ],
                ],
            ],
        ],
    ],
    'service_manager'  => [
        'factories' => [
            RemoteAddress::class => InvokableFactory::class,
        ],
    ],
    'controllers'  => [
        'factories' => [
            CvController::class => CvControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine'                           => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity'],
            ],
            'orm_default'             => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ],
            ],
        ],
    ],
    CvControllerFactory::CV_STORAGE_PATH => __DIR__ . '/../../../data/cvs/',
];
