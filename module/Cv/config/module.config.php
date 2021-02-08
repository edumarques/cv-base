<?php

declare(strict_types=1);

namespace Cv;

use Cv\Controller\CvController;
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
    'controllers'  => [
        'factories' => [
            CvController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'exception_template'  => 'error/index',
        'template_map'        => [
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
