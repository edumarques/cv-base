<?php

declare(strict_types=1);

namespace Cv\Controller;

use Cv\Entity\File;
use Cv\Form\CvForm;
use Cv\Entity\Cv;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Laminas\Http\PhpEnvironment\RemoteAddress;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

/** @method \Laminas\Http\PhpEnvironment\Request getRequest() */

/** @method \Laminas\Http\PhpEnvironment\Response getResponse() */
class CvController extends AbstractActionController
{
    protected EntityManager $entityManager;

    protected RemoteAddress $remoteAddress;

    protected string $cvStoragePath;


    public function __construct(
        EntityManager $entityManager,
        RemoteAddress $remoteAddress,
        string $cvStoragePath
    )
    {
        $this->entityManager = $entityManager;
        $this->remoteAddress = $remoteAddress;
        $this->cvStoragePath = $cvStoragePath;
    }


    public function sendAction(): ViewModel|Response
    {
        $request  = $this->getRequest();
        $response = $this->getResponse();
        $form     = CvForm::create();

        if (!$request->isPost()) {
            return new ViewModel(['form' => $form]);
        }

        $post = array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
        );

        if (empty($post)) {
            $response->setStatusCode(Response::STATUS_CODE_500);

            return new ViewModel(
                [
                    'form'  => $form,
                    'error' => 'There has been an error while submitting the data.'
                               . ' Please check the file size and/or try again.',
                ]
            );
        }

        $form->setData($post);

        if (!$form->isValid()) {
            $response->setStatusCode(Response::STATUS_CODE_400);

            return new ViewModel(['form' => $form]);
        }

        $data         = $form->getData();
        $fileData     = $data[Cv::FILE] ?? [];
        $tempFilePath = $fileData['tmp_name'] ?? '';

        unset($data[Cv::FILE]);
        $cvData = $data;

        $tempFileName = basename($tempFilePath, '.tmp');
        $filePath     = $this->cvStoragePath . $tempFileName . '-' . time();
        $moved        = copy($tempFilePath, $filePath);

        $file = new File();
        $file->exchangeArray($fileData);
        $file->setPath($filePath);
        $file->setUploadedAt(new \DateTime());

        $cv = new Cv();
        $cv->exchangeArray($cvData);
        $cv->setFile($file);
        $cv->setCreatedAt(new \DateTime());
        $cv->setIpAddress($this->remoteAddress->getIpAddress());

        $this->entityManager->persist($cv);
        $this->entityManager->flush();

        return new ViewModel(
            [
                'form'    => CvForm::create(),
                'success' => 'CV submitted successfully.',
            ]
        );
    }
}
