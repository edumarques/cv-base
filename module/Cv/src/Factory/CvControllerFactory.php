<?php

namespace Cv\Factory;

use Cv\Controller\CvController;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Laminas\Http\PhpEnvironment\RemoteAddress;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * @codeCoverageIgnore
 */
class CvControllerFactory implements FactoryInterface
{
    public const CV_STORAGE_PATH = 'cv-storage-path';


    /**
     * @inheritDoc
     * @return CvController
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): CvController
    {
        return new CvController(
            $container->get(EntityManager::class),
            $container->get(RemoteAddress::class),
            $container->get('config')[self::CV_STORAGE_PATH]
        );
    }
}