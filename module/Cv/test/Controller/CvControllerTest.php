<?php

declare(strict_types=1);

namespace CvTest\Controller;

use Cv\Controller\CvController;
use Laminas\Stdlib\Parameters;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class CvControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setApplicationConfig(
            include __DIR__ . '/../../../../config/application.test.config.php',
        );
    }


    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        include __DIR__ . '/../../../../data/clear-cv-storage-test.php';
    }


    public function testSendActionWithGetRequest(): void
    {
        $this->dispatch('/cv/send', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('cv');
        $this->assertControllerName(CvController::class);
        $this->assertControllerClass('CvController');
        $this->assertMatchedRouteName('send-cv');
        $this->assertQuery('.container .jumbotron form');
        $this->assertQuery('#submit-button');
        $this->assertNotQuery('.alert');
    }


    public function testSendActionWithPostRequestWithNoParams(): void
    {
        $this->dispatch('/cv/send', 'POST');
        $this->assertResponseStatusCode(500);
        $this->assertModuleName('cv');
        $this->assertControllerName(CvController::class);
        $this->assertControllerClass('CvController');
        $this->assertMatchedRouteName('send-cv');
        $this->assertQuery('.container .jumbotron form');
        $this->assertQueryCount(
            '.alert .alert-danger',
            1
        );
        $this->assertQueryContentContains(
            '.alert .alert-danger',
            '
        There has been an error while submitting the data. Please check the file size and/or try again.    '
        );
    }


    public function testSendActionWithPostRequestWithNotAllFields(): void
    {
        $this->dispatch('/cv/send', 'POST', ['name' => 'John Doe', 'position' => 'Engineer']);
        $this->assertResponseStatusCode(400);
        $this->assertModuleName('cv');
        $this->assertControllerName(CvController::class);
        $this->assertControllerClass('CvController');
        $this->assertMatchedRouteName('send-cv');
        $this->assertQuery('.container .jumbotron form');
        $this->assertQueryCount(
            'ul.alert.alert-danger li',
            4
        );
        $this->assertQueryContentContains(
            'ul.alert.alert-danger li',
            'Value is required and can\'t be empty'
        );
    }


    public function testSendActionWithPostRequestWithInvalidFields(): void
    {
        $post = [
            'name'      => 'John Doe',
            'email'     => 'john@email.com',
            'telephone' => '123',
            'position'  => 'Engineer',
            'education' => 'graduate',
        ];

        $this->dispatch('/cv/send', 'POST', $post);
        $this->assertResponseStatusCode(400);
        $this->assertModuleName('cv');
        $this->assertControllerName(CvController::class);
        $this->assertControllerClass('CvController');
        $this->assertMatchedRouteName('send-cv');
        $this->assertQuery('.container .jumbotron form');
        $this->assertQueryCount(
            'ul.alert.alert-danger li',
            2
        );
        $this->assertQueryContentContains(
            'ul.alert.alert-danger li',
            'The input is less than 5 characters long'
        );
    }


    public function testSendActionWithPostRequestTempFileDoesNotExist(): void
    {
        $post = [
            'id'        => '',
            'name'      => 'John Doe',
            'email'     => 'john@email.com',
            'telephone' => '12345',
            'position'  => 'Engineer',
            'education' => 'graduate',
        ];

        $file = [
            'file' => [
                'name'     => 'file_1.pdf',
                'type'     => 'application/pdf',
                'tmp_name' => __DIR__ . '/../../../../data/test/non_existent_file',
                'error'    => 0,
                'size'     => 0,
            ],
        ];

        $this->getRequest()->setFiles(new Parameters($file));

        $this->dispatch('/cv/send', 'POST', $post);
        $this->assertResponseStatusCode(400);
        $this->assertModuleName('cv');
        $this->assertControllerName(CvController::class);
        $this->assertControllerClass('CvController');
        $this->assertMatchedRouteName('send-cv');
        $this->assertQuery('.container .jumbotron form');
        $this->assertQueryCount('ul.alert.alert-danger li', 2);
        $this->assertQueryContentContains(
            'ul.alert.alert-danger li',
            'File is not readable or does not exist'
        );
    }


    public function testSendActionWithPostRequestSuccess(): void
    {
        $post = [
            'id'        => '',
            'name'      => 'John Doe',
            'email'     => 'john@email.com',
            'telephone' => '12345',
            'position'  => 'Engineer',
            'education' => 'graduate',
        ];

        $file = [
            'file' => [
                'name'     => 'file_1.pdf',
                'type'     => 'application/pdf',
                'tmp_name' => __DIR__ . '/../../../../data/test/dummy.tmp',
                'error'    => 0,
                'size'     => 0,
            ],
        ];

        $this->getRequest()->setFiles(new Parameters($file));

        $this->dispatch('/cv/send', 'POST', $post);
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('cv');
        $this->assertControllerName(CvController::class);
        $this->assertControllerClass('CvController');
        $this->assertMatchedRouteName('send-cv');
        $this->assertQuery('.container .jumbotron form');
        $this->assertQueryContentContains(
            '.container .alert .alert-success',
            '
        CV submitted successfully.    '
        );
        $this->assertNotQuery('ul.alert.alert-danger li');
    }
}
