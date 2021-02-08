<?php

declare(strict_types=1);

namespace Cv\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class CvController extends AbstractActionController
{
    public function sendAction(): ViewModel
    {
        return new ViewModel();
    }

}
